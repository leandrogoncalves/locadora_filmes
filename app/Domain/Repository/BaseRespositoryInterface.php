<?php

namespace App\Domain\Repository;

use Illuminate\Contracts\Support\Arrayable;

interface BaseRespositoryInterface
{
    public function where(array $filters): self;
    public function read(): Arrayable;
}
