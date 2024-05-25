<?php

declare(strict_types=1);

namespace App\Actions\v1\Auth;

use App\Enums\TokenAbility;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Throwable;

final class RefreshToken
{
    public function handle(Request $request): ApiErrorResponse | ApiSuccessResponse
    {
        try {
            $accessToken = $request->user()->createToken(
                'access_token',
                [TokenAbility::ACCESS_API->value],
                Carbon::now()->addMinutes(config('sanctum.expiration'))
            );

            return new ApiSuccessResponse(
                message: 'Token généré',
                data: [
                    'token' => $accessToken->plainTextToken,
                    'token_expiration' => now()->addMinutes(config('sanctum.expiration')),
                ],
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: $exception->getCode()
            );
        }
    }
}
