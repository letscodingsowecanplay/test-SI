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

        return redirect()->intended('/admin'); // atau dashboard sesuai role
    }
}
