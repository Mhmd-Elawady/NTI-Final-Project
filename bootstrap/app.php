 <?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;

// 👇 استدعاء الـ Middleware اللي عملناه
use App\Http\Middleware\InstructorMiddleware;
use App\Http\Middleware\StudentMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // ✅ تسجيل الـ middleware كـ alias
        $middleware->alias([
            'instructor' => InstructorMiddleware::class,
            'student' => StudentMiddleware::class,
        ]);

        // لو عايز تضيف global middleware أو تعدل على جروب web/api
        // مثال: 
        // $middleware->web(append: [
        //     \App\Http\Middleware\VerifyCsrfToken::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
