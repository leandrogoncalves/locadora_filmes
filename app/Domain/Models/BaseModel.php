<?php

declare(strict_types=1);

namespace App\Domain\Models;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Lazy\LazyUuidFromString;

class BaseModel extends Model
{
    public $incrementing = false;

    protected $keyType = 'string';

    public function getIdAttribute(): null|string|LazyUuidFromString
    {
        return $this->attributes['id'];
    }
}
