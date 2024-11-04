<?php

namespace App\Domain\Repository;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface BaseRespositoryInterface
{
    public function getQuery(): Builder;

    public function where(array $filters): self;

    public function read(): Arrayable;

    public function first(): ?Model;

    public function create(array $data): Model;

    public function beginTransaction(): void;

    public function commit(): void;

    public function rollBack(): void;
}
