<?php

declare(strict_types=1);

namespace App\Infrastructure\Exceptions;

use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class BookingErrorException extends \Exception
{
    public function render(): Response
    {
        Log::error($this->getMessage());

        return response([
            'error' => $this->getMessage(),
        ], StatusCodeInterface::STATUS_BAD_REQUEST);
    }
}
