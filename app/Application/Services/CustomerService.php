<?php

declare(strict_types=1);

namespace App\Application\Services;

use App\Domain\Repository\CustomerRepositoryInterface;

class CustomerService
{
    public function __construct(
        private CustomerRepositoryInterface $repository
    ) {}
}
