<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('posts', PostsController::class);

Route::apiResource('websites', WebsiteController::class);

Route::apiResource('users', UserController::class);
Route::prefix('users')->as('users.')->controller(UserController::class)->group(function () {
    Route::post('{user}/subscribe', 'subscribe')->name('subscribe');
    Route::post('{user}/unsubscribe', 'unsubscribe')->name('unsubscribe');
});
