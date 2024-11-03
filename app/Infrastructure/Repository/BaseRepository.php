<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repository\BaseRespositoryInterface;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRespositoryInterface
{
    public function __construct(
        protected DatabaseManager $databaseManager
    ) {}

    /**
     * @var Builder
     */
    protected Builder $query;

    public function getQuery(): Builder
    {
        return $this->query;
    }

    /**
     * @param array $filters
     * @return $this
     */
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

    /**
     * @return Arrayable
     */
    public function read(): Arrayable
    {
        return $this->query->get();
    }

    /**
     * @return Model|null
     */
    public function first(): Model|null
    {
        return $this->query->first();
    }

    public function create(array $data): Model
    {
        $model = $this->query->newModelInstance()->fill($data);
        $model->save();
        return $model;
    }

    public function beginTransaction(): void
    {
        $this->databaseManager->beginTransaction();
    }

    public function commit(): void
    {
        $this->databaseManager->commit();
    }

    public function rollBack(): void
    {
        $this->databaseManager->rollBack();
    }
}
