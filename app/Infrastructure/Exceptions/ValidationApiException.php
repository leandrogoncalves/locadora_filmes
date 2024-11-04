<?php

declare(strict_types=1);

namespace App\Infrastructure\Exceptions;

use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ValidationApiException extends \Exception
{
    public $validator;

    public function __construct($validator, $message = '', $code = 0, ?\Throwable $previous = null)
    {
        $this->validator = $validator;
        parent::__construct($message, $code, $previous);
    }

    public function render(): Response
    {
        Log::error($this->getMessage());

        return response([
            'error' => $this->getMessage(),
            'message' => $this->validator->getMessageBag()->toArray(),
        ], StatusCodeInterface::STATUS_UNPROCESSABLE_ENTITY);
    }
}
