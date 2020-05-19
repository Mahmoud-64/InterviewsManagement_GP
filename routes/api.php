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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('/users', 'UserController');
Route::get('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');

Route::group([
    'name' => 'jobs',
    'prefix' => 'jobs',
], function () {
    Route::get('/', 'JobController@index');
    Route::get('/{job}', 'JobController@show');
    Route::post('/', 'JobController@store');
    Route::Put('/{job}', 'JobController@update');
    Route::delete('/{Job}', 'JobController@destroy');
});
