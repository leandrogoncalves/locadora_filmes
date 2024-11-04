<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Models\Customer;
use App\Domain\Repository\CustomerRepositoryInterface;
use Illuminate\Database\DatabaseManager;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    public function __construct(
        private Customer $model,
        protected DatabaseManager $databaseManager
    ) {
        parent::__construct($databaseManager);
        $this->query = $model->newModelQuery();
    }
}
