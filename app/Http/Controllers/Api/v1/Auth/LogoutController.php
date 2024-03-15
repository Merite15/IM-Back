<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Responses\ApiSuccessResponse;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $token = auth()->user()->currentAccessToken();

        $token->delete();

        return new ApiSuccessResponse(message: 'Déconnecté avec succès');
    }
}
