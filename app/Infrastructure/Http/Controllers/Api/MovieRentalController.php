<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Controllers\Api;

use App\Application\Services\MovieRentalService;
use App\Infrastructure\Exceptions\BookingErrorException;
use App\Infrastructure\Exceptions\NotFoundException;
use App\Infrastructure\Http\Controllers\Api\Contracts\MovieRentalControllerInterface;
use App\Infrastructure\Http\Controllers\Controller;
use App\Infrastructure\Http\Requests\BookingConfirmationRequest;
use App\Infrastructure\Http\Requests\BookingMovieRequest;
use App\Infrastructure\Http\Requests\BookingReturnRequest;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;

class MovieRentalController extends Controller implements MovieRentalControllerInterface
{
    public function __construct(
        protected MovieRentalService $service
    ) {}

    public function booking(BookingMovieRequest $request): JsonResponse
    {
        try {
            return response()->json(
                $this->service->booking($request->validated())
            );
        } catch (NotFoundException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], StatusCodeInterface::STATUS_NOT_FOUND);
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

    public function confirmation(BookingConfirmationRequest $request): JsonResponse
    {
        try {
            return response()->json(
                $this->service->confirmation($request->validated())
            );
        } catch (BookingErrorException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], StatusCodeInterface::STATUS_UNPROCESSABLE_ENTITY);
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

    public function return(BookingReturnRequest $request): JsonResponse
    {
        try {
            return response()->json(
                $this->service->return($request->validated())
            );
        } catch (BookingErrorException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], StatusCodeInterface::STATUS_UNPROCESSABLE_ENTITY);
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
