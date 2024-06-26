<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Routes du TP2 ici : 
Route::get('/films', 'App\Http\Controllers\FilmController@index');

Route::middleware(['throttle:60,1', 'auth:sanctum'])->group(function(){
    Route::post('films', 'App\Http\Controllers\FilmController@create');
    Route::put('/films/{id}', 'App\Http\Controllers\FilmController@update');
    Route::delete('/films/{id}', 'App\Http\Controllers\FilmController@destroy');
    Route::post('/critics/{film_id}', 'App\Http\Controllers\CriticController@store');
    Route::get('/users/{id}', 'App\Http\Controllers\UserController@show');
    Route::patch('/users/{id}', 'App\Http\Controllers\UserController@update');
});

Route::middleware('throttle:5,1')->group(function () {
    Route::post('/signup', 'App\Http\Controllers\AuthController@register');
    Route::post('/signin', 'App\Http\Controllers\AuthController@login');
    Route::get('/signout',['middleware' => 'auth:sanctum', 'uses' => 'App\Http\Controllers\AuthController@logout']);
});