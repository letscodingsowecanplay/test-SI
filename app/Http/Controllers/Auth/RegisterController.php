<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validasi form pendaftaran untuk siswa.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nisn' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Buat user baru dengan role siswa.
     */
    protected function create(array $data)
    {
        // Format nama menjadi kapital di awal setiap kata
        $formattedName = ucwords(strtolower($data['name']));

        $user = User::create([
            'name' => $formattedName,
            'email' => $data['email'],
            'nisn' => $data['nisn'],
            'password' => Hash::make($data['password']),
            'status' => 1,
        ]);

        $user->assignRole('siswa');

        return $user;
    }
}
