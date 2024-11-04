<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movie_rentals', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->char('movieId', 36);
            $table->foreign('movieId')->references('id')->on('movies');
            $table->char('customerId', 36)->nullable();
            $table->foreign('customerId')->references('id')->on('customers');
            $table->string('reserveId')->nullable();
            $table->string('scheduleId')->nullable();
            $table->dateTime('reserve_date')->nullable();
            $table->date('schedule_date')->nullable();
            $table->date('return_date')->nullable();
            $table->enum('status', ['RESERVED', 'LEASED', 'RETURNED'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_rental');
    }
};
