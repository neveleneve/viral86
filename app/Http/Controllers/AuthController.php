<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    public function login(Request $request) {
        $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
            'remember' => ['boolean'],
        ]);

        $login_type = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$login_type => $request->email, 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();

            return redirect()
                ->intended('/')
                ->with([
                    'toast' => true,
                    'title' => 'Berhasil!',
                    'message' => 'Login Berhasil! Selamat datang kembali!',
                    'icon' => 'success',
                ]);
        }

        return back()
            ->with('error', 'Login Gagal! Email atau Password salah.')
            ->withErrors([
                'email' => 'Kredensial tidak cocok.'
            ]);
    }

    public function register(Request $request) {
        //
    }

    public function loginForm() {
        return inertia('Auth/Login');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with([
                'toast' => true,
                'title' => 'Berhasil Keluar!',
                'message' => 'Berhasil keluar dari akun Anda!',
                'icon' => 'success',
            ]);
    }
}
