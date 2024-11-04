<?php

declare(strict_types=1);

namespace App\Infrastructure\Exceptions;

use Exception;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class NotFoundException extends Exception
{
    public function render(): Response
    {
        Log::error($this->getMessage());

        return response([
            'error' => $this->getMessage(),
        ], StatusCodeInterface::STATUS_NOT_FOUND);
    }
}
