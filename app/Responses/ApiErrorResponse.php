<?php

declare(strict_types=1);

namespace App\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use Throwable;

final class ApiErrorResponse implements Responsable
{
    public function __construct(
        private string $message = 'Une erreur s\'est produite',
        private ?Throwable $exception = null,
        private ?bool $success = false,
        private int $code = Response::HTTP_INTERNAL_SERVER_ERROR,
        private array $headers = []
    ) {}

    /**
     * @return \Symfony\Component\HttpFoundation\Response|void
     */
    public function toResponse($request)
    {
        $response = [
            'success' => $this->success,
            'message' => $this->message,
            'error' =>  $this->exception->getMessage()
        ];

        if ($this->exception !== null && config('app.debug')) {
            $response['debug'] = [
                'message' => $this->exception->getMessage(),
                'file' => $this->exception->getFile(),
                'line' => $this->exception->getLine(),
                'trace' => $this->exception->getTraceAsString(),
            ];
        }

        return response()->json(
            $response,
            $this->code,
            $this->headers,
            $this->success
        );
    }
}
