<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\BaseRespositoryInterface;
use App\Domain\Repository\MovieRepositoryInterface;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;

abstract class BaseRepository implements BaseRespositoryInterface
{
    protected Builder $query;


    public function where(array $filters): self
    {
        foreach ($filters as $filter) {
            $this->query->where(
                data_get($filter, 'field', ''),
                data_get($filter, 'condition', '='),
                data_get($filter, 'value', '')
            );
        }
        return $this;
    }

    public function read(): Arrayable
    {
        return $this->query->get();
    }
}
