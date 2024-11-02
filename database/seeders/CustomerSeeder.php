<?php

namespace Database\Seeders;

use App\Domain\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::firstOrCreate([
            'uuid' => Uuid::uuid4(),
            'name' => fake()->name(),
            'email' => fake()->email(),
            'phone' => fake()->phoneNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
