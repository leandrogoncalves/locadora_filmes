<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'synopsis',
        'rating',
        'created_at',
        'updated_at',
    ];
}
