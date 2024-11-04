<?php

declare(strict_types=1);

namespace App\Application\Services;

use App\Domain\Models\Customer;
use App\Domain\Repository\CustomerRepositoryInterface;
use Ramsey\Uuid\Uuid;

class CustomerService
{
    public function __construct(
        private CustomerRepositoryInterface $repository
    ) {}

    public function fisrtOrCreate(array $customerData): Customer
    {
        $customer = $this->repository->where([
            [
                'field' => 'email',
                'value' => data_get($customerData, 'email'),
            ],
        ])->first();

        if ($customer instanceof Customer) {
            return $customer;
        }

        $customerData['id'] = Uuid::uuid4();

        return $this->repository->create($customerData);
    }
}
