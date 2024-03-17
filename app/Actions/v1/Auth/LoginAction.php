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

            $user = User::query()->with('roles.permissions', 'companies')->where('email', $data['email'])->first();

            if ( ! $user || ! Hash::check($data['password'], $user->password)) {
                throw new Exception('Les informations d\'identification fournies sont incorrectes.', Response::HTTP_UNAUTHORIZED);
            }

            if ($user->companies->count() === 0) {
                throw new Exception('Vous n’êtes affilié à aucun hôpital.', Response::HTTP_UNAUTHORIZED);
            }

            $user->update([
                'last_login_at' => Carbon::now(),
                'last_login_ip' => Request::getClientIp()
            ]);

            if ($user->companies->isNotEmpty() && request('company_id') === null) {
                return response([
                    'success' => true,
                    'message' => 'Veuillez sélectionner un hôpital',
                    'data' => $user,
                    'companies' => $user->companies,
                ]);
            }

            if (request()->has('company_id') && request('company_id') !== null) {
                $user->update([
                    'current_hospital' => request('company_id')
                ]);

                $data = [
                    'user' => $user,
                    'token' => $user->createToken($data['email'])->plainTextToken
                ];

                return new ApiSuccessResponse(
                    message: 'Connecté avec succès',
                    data: $data,
                );
            }
            throw new Exception('Vous devez spécifier un hôpital pour vous connecter en tant qu\'administrateur.', Response::HTTP_UNAUTHORIZED);

        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                exception: $exception,
                code: $exception->getCode()
            );
        }
    }
}
