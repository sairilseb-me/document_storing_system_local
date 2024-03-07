<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'role'], function (){
    Route::get('/', 'RoleController@index');
    Route::post('/store', 'RoleController@store');
    Route::get('/show/{id}', 'RoleController@show');
    Route::put('/update/{id}', 'RoleController@update');
    Route::delete('/delete/{id}', 'RoleController@destroy');
});