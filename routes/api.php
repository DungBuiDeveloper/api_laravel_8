<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ArticleController;
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
$adminRole = Config('const')['role']['admin'];

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::group(['prefix' => 'password'],function() {
        Route::post('/forgot', [ForgotPasswordController::class, 'getResetToken']);
        Route::post('/reset', [ChangePasswordController::class , 'passwordResetProcess']);
    });
});

//Auth
Route::group([
    'middleware' => 'auth:api'
], function ($router) use($adminRole) {
    Route::get('articles', 'App\Http\Controllers\ArticleController@index');
    Route::get('articles/{article}', 'App\Http\Controllers\ArticleController@show');
    Route::post('articles', 'App\Http\Controllers\ArticleController@store');
    Route::put('articles/{article}', 'App\Http\Controllers\ArticleController@update');
    Route::delete('articles/{article}', 'App\Http\Controllers\ArticleController@delete');

    Route::get('/me', [AuthController::class, 'userProfile']);

    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');

    //Admin Role
    Route::group([
        'middleware' => "auth.role:$adminRole",
        'prefix' => 'admin'
    ], function ($router) {
        Route::get('/admin-test', function () {
            return 'Hello World';
        });
    });
});

//404
Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@website.com',
        'status' => false
    ], 404);
});

//Sample CSV AND PDF 
Route::get('csv/articles', 'App\Http\Controllers\ArticleController@csv');
Route::get('pdf/articles', 'App\Http\Controllers\ArticleController@pdf');


