<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Models\Movie;
use App\Domain\Repository\MovieRepositoryInterface;

class MovieRepository extends BaseRepository implements MovieRepositoryInterface
{
    public function __construct(
        private Movie $model
    ) {
        $this->query = $model->newModelQuery();
    }
}
