<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Models\Movie;
use App\Domain\Models\RentalMovie;
use App\Domain\Repository\RentalMovieRepositoryInterface;

class RentalMovieRepositoryRepository extends BaseRepository implements RentalMovieRepositoryInterface
{
    public function __construct(
        private RentalMovie $model
    ) {}
}
