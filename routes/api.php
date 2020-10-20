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

// Route::group(['middleware' => 'auth:api'], function(){
//     Route::get('/db', [App\Http\Controllers\DatabaseController::class, 'getDatabase']);
//     Route::get('/db/{id}', [App\Http\Controllers\DatabaseController::class, 'getDatabaseByID']);
//     Route::post('/db', [App\Http\Controllers\DatabaseController::class, 'dbSave']);
//     Route::put('/db/{id}', [App\Http\Controllers\DatabaseController::class, 'updateRecord']);
//     Route::delete('/db/{id}', [App\Http\Controllers\DatabaseController::class, 'deleteRecord']);
// });

    Route::get('/db', [App\Http\Controllers\DatabaseController::class, 'getDatabase']);
    Route::get('/pagination', [App\Http\Controllers\DatabaseController::class, 'getDatabasePagination'])->middleware('test');;
    Route::get('/db/{id}', [App\Http\Controllers\DatabaseController::class, 'getDatabaseByID']);
    Route::post('/db', [App\Http\Controllers\DatabaseController::class, 'dbSave']);
    Route::put('/db/{id}', [App\Http\Controllers\DatabaseController::class, 'updateRecord']);
    Route::delete('/db/{id}', [App\Http\Controllers\DatabaseController::class, 'deleteRecord']);

    Route::get('file/country_list', [App\Http\Controllers\DatabaseController::class, 'downloadFile']);
    Route::post('file/country_list', [App\Http\Controllers\DatabaseController::class, 'saveFile']);

    Route::post('/login', [App\Http\Controllers\Api\Auth\LoginController::class, 'login']);
    Route::get('/users', [App\Http\Controllers\Api\DatabaseController::class, 'getUsers']);

    Route::get('/user', [App\Http\Controllers\Api\UserController::class, 'getUser']);