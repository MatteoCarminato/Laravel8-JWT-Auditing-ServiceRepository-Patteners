<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CompanieController;
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

/* Route Authentication */
Route::post('/login', [AuthenticationController::class, 'login'])->name('post.login');
Route::post('/register', [AuthenticationController::class, 'register'])->name('post.register');

Route::group(['middleware' => 'private'], function () {
    /* Route Authentication */
    Route::get('/profile', [AuthenticationController::class, 'profile'])->name('get.profile');

    Route::apiResources([
        'companies' => CompanieController::class,
        'users' => CompanieController::class,
    ]);


});
