<?php

use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            HandleInertiaRequests::class,
        ]);
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $e, Request $request) {
            if ($request->is('admin/*')) {

                $status = $e instanceof HttpException ? $e->getStatusCode() : 500;

                $errors = [
                    403 => [
                        'title' => 'Akses Ditolak',
                        'message' => 'Kamu tidak punya izin untuk masuk ke halaman ini!'
                    ],
                    404 => [
                        'title' => 'Halaman Tidak Ditemukan',
                        'message' => 'Halaman yang kamu cari tidak tersedia.'
                    ],
                    500 => [
                        'title' => 'Server Error',
                        'message' => 'Terjadi kesalahan pada server! Silakan coba lagi nanti.'
                    ],
                ];

                $error = $errors[$status] ?? ['title' => 'Terjadi Kesalahan', 'message' => 'Sesuatu yang salah telah terjadi.'];

                return inertia('Errors/ErrorPage', [
                    'status' => $status,
                    'title' => $error['title'],
                    'message' => $error['message']
                ])->toResponse($request)->setStatusCode($status);
            }
        });
    })
    ->create();
