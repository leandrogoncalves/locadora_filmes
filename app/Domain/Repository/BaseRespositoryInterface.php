<?php

namespace App\Domain\Repository;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface BaseRespositoryInterface
{
    /**
     * @return Builder
     */
    public function getQuery(): Builder;

    /**
     * @param array $filters
     * @return self
     */
    public function where(array $filters): self;

    /**
     * @return Arrayable
     */
    public function read(): Arrayable;

    /**
     * @return Model|null
     */
    public function first(): Model|null;

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * @return void
     */
    public function beginTransaction(): void;

    /**
     * @return void
     */
    public function commit(): void;

    /**
     * @return void
     */
    public function rollBack(): void;

}
