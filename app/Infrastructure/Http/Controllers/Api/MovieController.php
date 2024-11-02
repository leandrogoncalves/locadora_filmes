<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Controllers\Api;

use App\Application\Services\MovieService;
use App\Infrastructure\Http\Controllers\Controller;
use App\Infrastructure\Http\Requests\MovieRequest;
use Illuminate\Http\JsonResponse;

class MovieController extends Controller
{
    /**
     * @param MovieService $service
     */
    public function __construct(
        private MovieService $service
    ) {}

    /**
     * @param MovieRequest $request
     * @return JsonResponse
     */

    public function read(MovieRequest $request): JsonResponse
    {
        return response()->json(
            $this->service->readAll($request->validated())
        );
    }
}
