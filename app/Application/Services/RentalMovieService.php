<?php

declare(strict_types=1);

namespace App\Application\Services;

use App\Domain\Repository\RentalMovieRepositoryInterface;

class RentalMovieService
{
    public function __construct(
        private RentalMovieRepositoryInterface $repository
    ) {}
}
