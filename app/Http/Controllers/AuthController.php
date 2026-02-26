<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    public function login(Request $request) {
        $request->validate([
            'email' => ['required', 'string'], // Ini field inputnya
            'password' => ['required', 'string'],
            'remember' => ['boolean'],
        ]);

        $login_type = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$login_type => $request->email, 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();

            return redirect()
                ->intended('/')
                ->with('success', 'Selamat Datang Kembali!');
        }

        // 4. Jika Gagal
        return back()->with('error', 'Login Gagal! Email atau Password salah.')
            ->withErrors(['email' => 'Kredensial tidak cocok.']);
    }

    public function register(Request $request) {
        //
    }

    public function loginForm() {
        return inertia('Auth/Login');
    }
}
