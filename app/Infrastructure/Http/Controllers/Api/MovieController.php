<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Controllers\Api;

use App\Application\Services\MovieService;
use App\Infrastructure\Http\Controllers\Api\Contracts\MovieControllerInterface;
use App\Infrastructure\Http\Controllers\Controller;
use App\Infrastructure\Http\Requests\MovieRequest;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class MovieController extends Controller implements MovieControllerInterface
{
    public function __construct(
        private MovieService $service
    ) {}

    public function read(MovieRequest $request): JsonResponse
    {
        try {
            return response()->json(
                $this->service->readAll($request->validated())
            );
        } catch (Throwable $e) {
            Log::error($e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'error' => 'Erro interno do servidor',
            ], StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR);
        }
    }
}
