<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\QueryException;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \App\Http\Middleware\EnsureUserHasRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // 1) Memastikan rute /api/* selalu dijawab JSON walau header Accept lupa dikirim
        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
            return $request->is('api/*') || $request->expectsJson();
        });

        // 2) Pesan 404 API dalam bahasa Indonesia
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data atau endpoint API laundry tidak ditemukan.'
                ], 404);
            }
        });

        // 3) Penanganan pelanggaran Foreign Key (MySQL 1451) -> pesan ramah, bukan error 500[cite: 50, 51]
        $exceptions->render(function (QueryException $e, Request $request) {
            if (($e->errorInfo[1] ?? null) === 1451) {
                $pesan = 'Data ini masih terikat dengan transaksi lain sehingga tidak dapat dihapus.';
                return $request->expectsJson()
                    ? response()->json(['success' => false, 'message' => $pesan], 409)
                    : back()->with('errors', $pesan);
            }
        });
    })->create();