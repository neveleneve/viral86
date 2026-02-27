<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware {
    protected $rootView = 'app';

    public function version(Request $request): ?string {
        return parent::version($request);
    }

    public function share(Request $request): array {
        return [
            ...parent::share($request),
            'appName' => env('VITE_APP_NAME', 'Berandanesia'),
            'appName1' => env('VITE_APP_NAME_1', 'Beranda'),
            'appName2' => env('VITE_APP_NAME_2', 'nesia'),
            'flash' => [
                'toast' => $request->session()->get('toast'),
                'icon' => $request->session()->get('icon'),
                'title' => $request->session()->get('title'),
                'message' => $request->session()->get('message'),
            ],
            'auth' => [
                'user' => $request->user() ? [
                    'id' => $request->user()->id,
                    'username' => $request->user()->username,
                    'name' => $request->user()->name,
                    'email' => $request->user()->email,
                    'roles' => $request->user()->getRoleNames(),
                    'permissions' => $request->user()->getAllPermissions()->pluck('name'),
                ] : null,
            ],
        ];
    }
}
