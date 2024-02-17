<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DogController;
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Para acceder al crud de razas de perros, le doy el prefijo de dogs
Route::prefix('dogs')->group(function () {
    Route::get('get-breeds', [DogController::class, 'getBreeds']);
    Route::post('update-breed', [DogController::class, 'updateBreed'])->middleware(['auth:sanctum']);;
    Route::post('filter-breed', [DogController::class, 'filterBreed'])->middleware(['auth:sanctum']);;
    Route::post('create-breed', [DogController::class, 'createBreed'])->middleware(['auth:sanctum']);
    Route::post('delete-breed', [DogController::class, 'deleteBreed'])->middleware(['auth:sanctum']);
});

Route::prefix('users')->group(function () {
    Route::post('login', [AuthController::class, 'signIn']);
    Route::post('logout', [AuthController::class, 'logOut']);
});
