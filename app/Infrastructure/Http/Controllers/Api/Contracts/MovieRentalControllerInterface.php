<?php

namespace App\Infrastructure\Http\Controllers\Api\Contracts;

use App\Infrastructure\Http\Requests\BookingConfirmationRequest;
use App\Infrastructure\Http\Requests\BookingMovieRequest;
use App\Infrastructure\Http\Requests\BookingReturnRequest;
use Illuminate\Http\JsonResponse;

interface MovieRentalControllerInterface
{
    /**
     * @OA\Post(
     *     path="/api/v1/rental",
     *     summary="Retorna o Id da reserva do filme",
     *     tags={"Rental movie"},
     *     @OA\RequestBody(
     *        required=true,
     *        @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *                type="object",
     *                @OA\Property(
     *                    property="movieId",
     *                    type="string",
     *                    description="ID do filme",
     *                    example="1aa219ef-c8a0-4d86-8bd3-244cbd07e632"
     *                ),
     *            ),
     *        )
     *    ),
     *     @OA\Response(
     *         response="200",
     *         description="Filmes",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                    type="object",
     *                          @OA\Property(
     *                            property="reserveId",
     *                            type="string",
     *                            example="1aa219ef-c8a0-4d86-8bd3-244cbd07e632"
     *                         ),
     *                 )
     *             )
     *         }
     *     ),
     *     @OA\Response(response="422", description="Erro de validação"),
     *     @OA\Response(response="500", description="Erro interno do servidor")
     * ),
     */
    public function booking(BookingMovieRequest $request): JsonResponse;

    /**
     * @OA\Post(
     *     path="/api/v1/rental/confirmation",
     *     summary="Retorna o Id da confirmação de aluguel do filme",
     *     tags={"Rental movie"},
     *     @OA\RequestBody(
     *        required=true,
     *        @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *                type="object",
     *                @OA\Property(
     *                    property="reserveId",
     *                    type="string",
     *                    description="ID da reserva",
     *                    example="1aa219ef-c8a0-4d86-8bd3-244cbd07e632"
     *                ),
     *                @OA\Property(
     *                     property="customer",
     *                     type="object",
     *                     description="Dados do cliente",
     *                      @OA\Property(
     *                          property="name",
     *                          type="string",
     *                          description="Nome do cliente",
     *                     ),
     *                     @OA\Property(
     *                           property="email",
     *                           type="string",
     *                           description="E-mail do cliente",
     *                      ),
     *                    @OA\Property(
     *                           property="phone",
     *                           type="string",
     *                           description="Telefone do cliente",
     *                      ),
     *                 ),
     *            ),
     *        )
     *    ),
     *     @OA\Response(
     *         response="200",
     *         description="Filmes",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                    type="object",
     *                          @OA\Property(
     *                            property="scheduleId",
     *                            type="string",
     *                            example="1aa219ef-c8a0-4d86-8bd3-244cbd07e632"
     *                         ),
     *                         @OA\Property(
     *                             property="status",
     *                             type="string",
     *                             example="LEASED"
     *                          ),
     *                 )
     *             )
     *         }
     *     ),
     *     @OA\Response(response="422", description="Erro de validação"),
     *     @OA\Response(response="500", description="Erro interno do servidor")
     * ),
     */
    public function confirmation(BookingConfirmationRequest $request): JsonResponse;

    /**
     * @OA\Post(
     *     path="/api/v1/rental/return",
     *     summary="Faz a devolução do filme",
     *     tags={"Rental movie"},
     *     @OA\RequestBody(
     *        required=true,
     *        @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(
     *                type="object",
     *                @OA\Property(
     *                    property="scheduleId",
     *                    type="string",
     *                    description="ID da confirmação de aluguel",
     *                    example="1aa219ef-c8a0-4d86-8bd3-244cbd07e632"
     *                ),
     *            ),
     *        )
     *    ),
     *     @OA\Response(
     *         response="200",
     *         description="Filmes",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                    type="object",
     *                          @OA\Property(
     *                            property="scheduleId",
     *                            type="string",
     *                            example="1aa219ef-c8a0-4d86-8bd3-244cbd07e632"
     *                         ),
     *                        @OA\Property(
     *                             property="status",
     *                             type="string",
     *                             example="RETURNED"
     *                          ),
     *                 )
     *             )
     *         }
     *     ),
     *     @OA\Response(response="422", description="Erro de validação"),
     *     @OA\Response(response="500", description="Erro interno do servidor")
     * ),
     */
    public function return(BookingReturnRequest $request): JsonResponse;


}
