<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        // Add exceptions you don't want to report
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling for the application.
     *
     * @return void
     */
    public function register()
    {
        // Register custom exception handling if needed
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request  $request
     * @param \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        // Check for throttle exceptions (rate limiting)
        if ($exception instanceof ThrottleRequestsException) {
            // Check if the request expects a JSON response
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'You have reached the maximum request limit. Please try again later.',
                    'error' => 'Too Many Requests',
                    'status_code' => 429
                ], 429);
            }

            // If it's not a JSON request, fallback to the default HTML response
            return response()->view('errors.429', [], 429);
        }

        // Handle other exceptions using the parent method
        return parent::render($request, $exception);
    }

}
