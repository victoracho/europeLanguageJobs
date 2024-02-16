<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DogsController;

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
    // Get testimonials.
    // Send contact email.
    Route::post('get-breeds', [DogsController::class, 'getBreeds']);
    Route::post('update-breed', [DogsController::class, 'updateBreed']);
    Route::post('create-breed', [DogsController::class, 'createBreed']);
    Route::post('delete-breed', [DogsController::class, 'deleteBreed']);
});
