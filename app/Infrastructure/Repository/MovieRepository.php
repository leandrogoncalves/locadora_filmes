<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Models\Movie;
use App\Domain\Repository\MovieRepositoryInterface;
use Illuminate\Database\DatabaseManager;

class MovieRepository extends BaseRepository implements MovieRepositoryInterface
{
    public function __construct(
        private Movie $model,
        protected DatabaseManager $databaseManager
    ) {
        parent::__construct($databaseManager);
        $this->query = $model->newModelQuery();
    }
}
