<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Repository\CustomerRepositoryInterface;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    public function __construct(
        private Customer $model
    ) {}

}
