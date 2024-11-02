<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'name',
        'synopsis',
        'rating',
        'created_at',
        'updated_at',
    ];
}
