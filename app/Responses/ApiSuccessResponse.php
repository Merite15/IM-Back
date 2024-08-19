<?php

declare(strict_types=1);

namespace App\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;

class ApiSuccessResponse implements Responsable
{
    /**
     * @param  mixed  $data
     */
    public function __construct(
        private string $message,
        private mixed $data = null,
        private ?bool $success = true,
        private int $code = Response::HTTP_OK,
        private array $headers = [],
        private bool $envelope = false,
        private array $stat = [],
    ) {}

    /**
     * @return \Symfony\Component\HttpFoundation\Response|void
     */
    public function toResponse($request)
    {
        if ($this->envelope) {
            $responseData = [
                'success' => $this->success,
                'message' => $this->message,
            ];

            if ($this->data !== null) {
                $responseData['data'] = $this->data;
            }

            if (! empty($this->stat)) {
                $responseData['stat'] = $this->stat;
            }
        } else {
            $responseData = $this->data;
        }

        return response()->json($responseData, $this->code, $this->headers);
    }
}
