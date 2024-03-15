<?php

declare(strict_types=1);

namespace App\Actions\v1\Auth;

use App\DTO\v1\Auth\LoginDTO;
use App\Models\User;
use App\Responses\ApiErrorResponse;
use App\Responses\ApiSuccessResponse;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Throwable;

final class LoginAction
{
    public function handle(LoginDTO $dto): ApiErrorResponse | Exception | ApiSuccessResponse
    {
        try {
            $data = $dto->toArray();

            $user = User::query()->with('roles.permissions')->where('email', $data['email'])->first();

            if ( ! $user || ! Hash::check($data['password'], $user->password)) {
                throw new Exception('Les informations d\'identification fournies sont incorrectes.', Response::HTTP_UNAUTHORIZED);
            }

            $user->update([
                'last_login_at' => Carbon::now(),
                'last_login_ip' => Request::getClientIp()
            ]);

            $data = [
                'user' => $user,
                'token' => $user->createToken($data['email'])->plainTextToken
            ];

            return new ApiSuccessResponse(
                message: 'Connecté avec succès',
                data: $data,
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: $exception->getCode()
            );
        }
    }
}
