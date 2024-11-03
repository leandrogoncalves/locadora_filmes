<?php

declare(strict_types=1);

namespace App\Application\Services;

use App\Domain\Models\Movie;
use App\Domain\Repository\MovieRepositoryInterface;
use App\Infrastructure\Exceptions\NotFoundException;
use Illuminate\Contracts\Support\Arrayable;

class MovieService
{
    /**
     * @param MovieRepositoryInterface $repository
     */
    public function __construct(
        private MovieRepositoryInterface $repository
    ) {}

    /**
     * @param array $filters
     * @return Arrayable
     */
    public function readAll(array $filters = []): Arrayable
    {
        $filters = array_map(
            fn($filter, $name) => ['field' => $name, 'value' => $filter],
            $filters,
            array_keys($filters)
        );

        return $this->repository->where($filters)->read();
    }

    public function readById(string $id): Movie
    {
        $movie = $this->repository->where([[
            'field' => 'id',
            'value' => $id,
        ]])->first();

        if (!$movie instanceof Movie) {
            throw new NotFoundException('Filme não encontrado');
        }

        return $movie;
    }
}
