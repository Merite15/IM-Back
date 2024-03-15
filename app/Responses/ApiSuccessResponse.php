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
        private array $stat = []
    ) {}

    /**
     * @return \Symfony\Component\HttpFoundation\Response|void
     */
    public function toResponse($request)
    {
        $responseData = [
            'success' => $this->success,
            'message' => $this->message,
        ];

        if ($this->data !== null) {
            $responseData['data'] = $this->data;
        }

        if ( ! empty($this->stat)) {
            $responseData['stat'] = $this->stat;
        }

        return response()->json($responseData, $this->code, $this->headers);
    }
}
