<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e): void {});

        $this->renderable(function (AuthenticationException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Votre token est invalide, veuillez vous reconnecter',
                    'error' => $e->getMessage(),
                ], 403);
            }
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => "Cette route n'existe pas",
                    'error' => $e->getMessage(),
                ], 404);
            }
        });

        $this->renderable(function (UnauthorizedException $e, $request) {
            if ($request->is('api/*')) {
                return response([
                    'success' => false,
                    'message' => "Vous n'êtes pas habilité à accéder à cette ressource (" . $e->getMessage() . ')',
                    'error' => $e->getMessage(),
                ], 401);
            }
        });

        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response([
                    'success' => false,
                    'message' => "Cette route n'est pas supporté par cette méthode HTTP",
                    'error' => $e->getMessage(),
                ], 402);
            }
        });

        $this->renderable(function (ValidationException $e, $request): void {
            if ($request->is('api/*')) {
                $errors = $e->validator->getMessageBag()->toArray();

                $display_errors = [];

                foreach ($errors as $value) {
                    $display_errors[] = $value[0];
                }

                throw new HttpResponseException(
                    response([
                        'success' => false,
                        'message' => 'Données invalides ***',
                        'errors' => $display_errors,
                    ], 422),
                );
            }
        });
    }
}
