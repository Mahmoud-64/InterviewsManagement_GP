<?php

use App\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

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
/////////////////////////////////////////////////
// use this middleware for unauthenticated users
// middleware('auth:unAthenticated')
/////////////////////////////////////////////////

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/LoggedInUser', function () {
        return new UserResource(Auth::user());
    });
    Route::get('/LogoutUser', function () {
        $user = Auth::user();
        return $user->tokens()->delete();
    });
    Route::put('resetpassword/{user}', 'Auth\ResetPasswordController@update');

    Route::apiResource('/users', 'UserController');
    Route::apiResource('/contacttype', 'Contact\ContactTypeController');
    Route::apiResource('/contact', 'Contact\ContactController');
});

Route::get('/register', 'Auth\RegisterController@register');

# Jobs #
Route::group([
    'prefix' => 'jobs',
    'middleware'=>'auth:sanctum'
], function () {
    Route::post('/', 'JobController@store');
    Route::Put('/{job}', 'JobController@update');
    Route::delete('/{job}', 'JobController@destroy');
});
    Route::get('jobs/', 'JobController@index');
    Route::get('jobs/{job}', 'JobController@show');



# job requirement admin only need to be rename #
Route::group([
    'prefix' => 'jobrequirements',
    'middleware'=>'auth:sanctum'
], function () {
    Route::get('/', 'JobRequirementController@index');
    Route::get('/{jobRequirement}', 'JobRequirementController@show');
    Route::post('/', 'JobRequirementController@store');
    Route::Put('/{jobRequirement}', 'JobRequirementController@update');
    Route::delete('/{jobRequirement}', 'JobRequirementController@destroy');
});

# app status admin only #
Route::group([
    'name' => 'appstatuses',
    'prefix' => 'appstatuses',
    'middleware'=>'auth:sanctum'
], function () {
    Route::get('/', 'AppStatusController@index');
    Route::get('/{appStatus}', 'AppStatusController@show');
    Route::post('/', 'AppStatusController@store');
    Route::Put('/{appStatus}', 'AppStatusController@update');
    Route::delete('/{appStatus}', 'AppStatusController@destroy');
});

# application #
Route::group([
    'name' => 'applications',
    'prefix' => 'applications',
    'middleware'=>'auth:sanctum'
], function () {
    Route::get('/', 'ApplicationController@index');
    Route::get('/{application}', 'ApplicationController@show');
    Route::post('/', 'ApplicationController@store');
    Route::Put('/{application}', 'ApplicationController@update');
    Route::delete('/{application}', 'ApplicationController@destroy');
});




Route::post('/login', 'Auth\LoginController@login');
Route::post('/register', 'Auth\RegisterController@register');
// hit this route only if verification tokken corrupted
// Route::post('/verifyphone', 'Auth\RegisterController@verifyPhone');
Route::post('/checkphone', 'Auth\RegisterController@checkPhoneVerification')->middleware('auth:sanctum');



Route::apiResource('seekers', 'SeekerController');
Route::apiResource('employees', 'EmployeeController');

//#################interviews###########################
Route::get('interviews', 'InterviewController@index');
Route::get('interview/{id}', 'InterviewController@show');
Route::post('interview', 'InterviewController@store');
Route::put('interview/{id}', 'InterviewController@update');
Route::delete('interview/{id}', 'InterviewController@destroy');
//#######################################################
