<?php

declare(strict_types=1);

namespace App\Actions\v1\Auth;

use App\DTO\v1\Auth\LoginDTO;
use App\Enums\TokenAbility;
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
    public function handle(LoginDTO $dto): ApiErrorResponse | Exception | ApiSuccessResponse | Response
    {
        try {
            $user = User::query()->with('roles.permissions', 'currentCompany', 'companies')->where('email', $dto->getEmail())->first();

            if (!$user || !Hash::check($dto->getPassword(), $user->password)) {
                throw new Exception('Les informations d\'identification fournies sont incorrectes.');
            }

            if ($user->companies->count() === 0) {
                throw new Exception('Vous n’êtes affilié à aucune compagnie.');
            }

            if ($user->companies->isNotEmpty() && request('company_id') === null) {
                return response([
                    'success' => true,
                    'message' => 'Veuillez sélectionner une compagnie',
                    'data' => $user->companies,
                ]);
            }

            if (request()->has('company_id') && request('company_id') !== null) {
                $user->update([
                    'last_login_at' => Carbon::now(),
                    'last_login_ip' => Request::getClientIp()
                ]);

                $user->update([
                    'current_company' => request('company_id')
                ]);

                $accessToken = $user->createToken('access_token', [TokenAbility::ACCESS_API->value], Carbon::now()->addMinutes(config('sanctum.expiration')));

                $refreshToken = $user->createToken('refresh_token', [TokenAbility::ISSUE_ACCESS_TOKEN->value], Carbon::now()->addMinutes(config('sanctum.rt_expiration')));

                $data = [
                    'user' => $user,
                    'token' => $accessToken->plainTextToken,
                    'token_expiration' => now()->addMinutes(config('sanctum.expiration')),
                    'refresh_token' => $refreshToken->plainTextToken
                ];

                return new ApiSuccessResponse(
                    message: 'Connecté avec succès',
                    data: $data,
                );
            }
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                // code: $exception->getCode()
            );
        }
    }
}
