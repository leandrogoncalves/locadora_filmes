<?php

namespace Database\Seeders;

use App\Domain\Models\Movie;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Movie::firstOrCreate([
            'id' => Uuid::uuid4(),
            'name' => fake()->domainName(),
            'synopsis' => fake()->text(),
            'rating' => '10',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
