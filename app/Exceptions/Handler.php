<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionsHandler;
use Throwable;

class Handler extends ExceptionsHandler{

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];
    public function register(): void
    {
        $this->renderable(function (Throwable $e){
            return response(['error' => $e->getMessage()],$e->getCode() ?: 400);
        });
    }
}