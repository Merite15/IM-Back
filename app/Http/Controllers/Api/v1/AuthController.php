<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1;

use App\Actions\v1\Auth\LoginAction;
use App\DTO\v1\Auth\LoginDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\Auth\LoginRequest;
use App\Responses\ApiSuccessResponse;

class AuthController extends Controller
{
    public function login(LoginRequest $request, LoginAction $action)
    {
        return $action->handle(LoginDTO::fromRequest($request));
    }

    public function logout()
    {
        $token = auth()->user()->currentAccessToken();

        $token->delete();

        return new ApiSuccessResponse(message: 'Déconnecté avec succès');
    }
}
