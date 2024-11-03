<?php

declare(strict_types=1);

namespace App\Domain\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MovieRental extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'id',
        'movieId',
        'customerId',
        'reserveId',
        'scheduleId',
        'status',
        'reserve_date',
        'schedule_date',
        'return_date',
        'created_at',
        'updated_at',
    ];

    public function getReserveDateAttribute(): Carbon
    {
        return Carbon::parse($this->attributes['reserve_date']);
    }
}
