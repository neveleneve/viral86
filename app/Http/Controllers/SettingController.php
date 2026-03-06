<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class SettingController extends Controller {
    public function index() {
        return inertia('Authenticated/Settings/Index');
    }

    public function changeProfile(Request $request) {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'alpha_dash', 'max:255', Rule::unique('users', 'username')->ignore(Auth::d())],
                'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore(Auth::id())],
            ]);

            $user = $request->user();

            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
            ]);

            return Redirect::back()->with([
                'toast' => true,
                'title' => 'Berhasil!',
                'message' => 'Data pengguna berhasil diubah!',
                'icon' => 'success',
            ]);
        } catch (Exception $e) {
            return Redirect::back()->with([
                'toast' => true,
                'title' => 'Gagal!',
                'message' => 'Data pengguna gagal diubah! '. $e->getMessage(),
                'icon' => 'success',
            ]);
        }
    }

    public function changePassword(Request $request) {
        //
    }
}
