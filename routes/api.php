<?php

use App\Http\Controllers\AuthenticationController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* Route Authentication */
Route::post('/login', [AuthenticationController::class, 'login'])->name('post.login');
Route::post('/register', [AuthenticationController::class, 'register'])->name('post.register');

Route::group(['middleware' => 'private'], function () {
    Route::get('/profile', [AuthenticationController::class, 'profile'])->name('get.profile');

});
