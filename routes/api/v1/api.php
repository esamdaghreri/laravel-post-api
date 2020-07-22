<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\User as UserResource;
use App\Models\User;
use App\Http\Controllers\PostController;

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


// =-=-=-=-=-= User Routes =-=-=-=-=-=

// Global access without authentication
Route::get('/posts', 'Api\V1\User\PostController@index');


Route::prefix('/user')->group(function() {
    // Login route
    Route::post('/login', 'Api\V1\User\Auth\LoginController@login');
    // Register route
    Route::post('/register', 'Api\V1\User\Auth\RegisterController@register');

    // Access routes with authentication
    Route::middleware('auth:api')->group(function() {
        Route::get('/data', 'Api\V1\User\UserController@currentData');
    });
});

Route::prefix('/post')->group(function() {
    // Access routes with authentication
    Route::middleware('auth:api')->group(function() {
        Route::post('/', 'Api\V1\User\PostController@store');
        Route::put('/{id}', 'Api\V1\User\PostController@update');
        Route::delete('/{id}', 'Api\V1\User\PostController@destroy');
    });
    // Access routes without authentication
    Route::get('/{id}', 'Api\V1\User\PostController@show');
});

