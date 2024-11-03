<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Infrastructure\Http\Controllers\Api\MovieController;
use App\Infrastructure\Http\Controllers\Api\MovieRentalController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('health', function (){
    return response()->json(['status' => 'Operational']);
})->name('api.health');;

Route::group(['prefix' => '/v1'], function () {
    Route::get('/movies', [MovieController::class, 'read'])
        ->name('api.movies.read');

    Route::group(['prefix' => '/rental'], function () {
        Route::post('/', [MovieRentalController::class, 'booking'])
            ->name('api.rental.booking');
        Route::post('/confirmation', [MovieRentalController::class, 'confirmation'])
            ->name('api.rental.confirmation');
        Route::post('/return', [MovieRentalController::class, 'return'])
            ->name('api.rental.return');
    });
});


