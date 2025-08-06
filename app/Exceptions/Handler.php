<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * Register exception handling callbacks for the application.
     */
    public function register(): void
    {
        //
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $exception)
    {
        // Si es un error de validación y NO es petición JSON, redirige a la vista con errores
        if ($exception instanceof ValidationException && !$request->expectsJson()) {
            return redirect()
                ->back()
                ->withErrors($exception->errors())
                ->withInput();
        }

        return parent::render($request, $exception);
    }
}