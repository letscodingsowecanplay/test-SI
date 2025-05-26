<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Di LoginController
    public function login(Request $request)
    {
        $request->validate([
            'identity' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cari user berdasarkan NIP atau NISN
        $user = \App\Models\User::where('nip', $request->identity)
                    ->orWhere('nisn', $request->identity)
                    ->first();

        if (!$user) {
            return back()->withErrors(['identity' => 'NIP/NISN tidak ditemukan']);
        }

        // Cek password
        if (!\Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password salah']);
        }

        Auth::login($user);

        // Redirect sesuai role kalau mau
        if ($user->hasRole('Admin')) {
            return redirect('/admin'); // atau dashboard guru
        } elseif ($user->hasRole('Siswa')) {
            return redirect('/admin'); // atau dashboard siswa
        }
        return redirect('/home');
    }


    // Di LoginController.php

    public function showGuruLoginForm()
    {
        // Kirim param jenis login (opsional) ke view, supaya form tahu labelnya
        return view('auth.login-guru', ['role' => 'admin']);
    }

    public function showSiswaLoginForm()
    {
        return view('auth.login-siswa', ['role' => 'siswa']);
    }

}
