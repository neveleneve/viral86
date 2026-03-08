<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class SettingController extends Controller {
    public function index() {
        return inertia('Authenticated/Settings/Index');
    }

    public function changeProfile(Request $request) {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => [
                    'required',
                    'string',
                    'max:255',
                    'alpha_dash',
                    Rule::unique('users', 'username')->ignore(Auth::id())
                ],
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users', 'email')->ignore(Auth::id())
                ],
            ]);

            $user = $request->user();
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
            ]);

            return Redirect::back()->with([
                'toast' => true,
                'icon' => 'success',
                'message' => 'Profil berhasil diperbarui!'
            ]);
        } catch (ValidationException $e) {
            throw $e;
        } catch (Exception $e) {
            Log::error('Gagal update profil: ' . $e->getMessage());

            return Redirect::back()->with([
                'toast' => true,
                'icon' => 'error',
                'message' => 'Terjadi kesalahan sistem, data gagal diubah.'
            ]);
        }
    }

    public function changePassword(Request $request) {
        $request->validate([
            'oldPassword' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ], [
            'oldPassword.current_password' => 'Password lama Anda tidak cocok.',
            'password.confirmed' => 'Konfirmasi password baru tidak sesuai.',
        ]);
        try {
            $user = $request->user();
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return Redirect::back()->with([
                'toast' => true,
                'icon' => 'success',
                'message' => 'Password berhasil diamankan!'
            ]);
        } catch (ValidationException $e) {
            throw $e;
        } catch (Exception $e) {
            Log::error('Gagal update password: ' . $e->getMessage());

            return Redirect::back()->with([
                'toast' => true,
                'icon' => 'error',
                'message' => 'Gagal mengubah password. Silakan coba lagi.'
            ]);
        }
    }
}
