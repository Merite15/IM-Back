<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1\Auth;

use App\Actions\v1\Auth\LoginAction;
use App\DTO\v1\Auth\LoginDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Auth\LoginRequest;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request, LoginAction $action)
    {
        return $action->handle(LoginDTO::fromRequest($request));
    }
}
