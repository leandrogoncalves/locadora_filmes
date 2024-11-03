<?php

namespace App\Infrastructure\Http\Controllers\Api\Contracts;

use App\Infrastructure\Http\Requests\MovieRequest;
use Illuminate\Http\JsonResponse;

interface MovieControllerInterface
{
    /**
     * @OA\Get(
     *     path="/api/v1/movies",
     *     summary="Retorna a lista de filmes cadastrados",
     *     tags={"Movies"},
     *     @OA\Response(
     *         response="200",
     *         description="Filmes",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                    type="array",
     *                     @OA\Items(
     *                          @OA\Property(
     *                            property="id",
     *                            type="string",
     *                            example="1aa219ef-c8a0-4d86-8bd3-244cbd07e632"
     *                         ),
     *                         @OA\Property(
     *                            property="name",
     *                            type="string",
     *                            example="Filme teste"
     *                         ),
     *                         @OA\Property(
     *                            property="synopsis",
     *                            type="string",
     *                            example="Teste"
     *                         ),
     *                         @OA\Property(
     *                            property="rating",
     *                            type="number",
     *                            example="10"
     *                         ),
     *                       ),
     *                 )
     *             )
     *         }
     *     ),
     *     @OA\Response(response="422", description="Erro de validação"),
     *     @OA\Response(response="500", description="Erro interno do servidor")
     * )
     */
    public function read(MovieRequest $request): JsonResponse;
}
