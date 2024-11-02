<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalMovie extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'movieId',
        'customerId',
        'reserveId',
        'status',
        'created_at',
        'updated_at',
    ];
}
