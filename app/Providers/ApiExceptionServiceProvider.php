<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class ApiExceptionServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->registerApiExceptionHandler();
    }

    protected function registerApiExceptionHandler(): void
    {
        app('Illuminate\Contracts\Debug\ExceptionHandler')->renderable(function (Throwable $e, $request) {

            // Only handle API requests
            if (! $request->is('api/*') && ! $request->expectsJson()) {
                return null; // let Laravel handle web exceptions normally
            }

            $status = 500;
            $message = 'Something went wrong';

            if ($e instanceof ValidationException) {
                $status = 422;
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors(),
                ], $status);
            }

            if ($e instanceof AuthenticationException) {
                $status = 401;
                $message = 'Unauthenticated';
            }

            if ($e instanceof NotFoundHttpException) {
                $status = 404;
                $message = 'Resource not found';
            }

            if ($e instanceof MethodNotAllowedHttpException) {
                $status = 405;
                $message = 'Method not allowed';
            }

            return response()->json([
                'success' => false,
                'message' => $message,
            ], $status);
        });
    }
}
