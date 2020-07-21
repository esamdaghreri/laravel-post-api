<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\User as UserResource;
use App\User;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::get('/user', function() {
//     return new UserResource(User::findorFail(1));
// });

// Post routes
Route::get('/posts', 'PostController@index');
Route::get('/post/{id}', 'PostController@show');
Route::post('/post', 'PostController@store');
Route::put('/post', 'PostController@store');
Route::delete('/post/{id}', 'PostController@destroy');

// User routes
Route::get('/users', 'UserController@index');
Route::get('/user/{id}', 'UserController@show');
Route::post('/user', 'UserController@store');
Route::put('/user', 'UserController@store');
Route::delete('/user/{id}', 'UserController@destroy');

