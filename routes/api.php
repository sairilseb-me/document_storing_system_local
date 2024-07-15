<?php

use App\Http\Controllers\OfficeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\AuthenticatedSessionController;


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


Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);

Route::group(['middleware' => ['auth:sanctum']], function(){

    Route::group(['prefix' => 'role'], function (){
        Route::get('/search/{role_name}', [RoleController::class, 'search']);
        Route::get('/', [RoleController::class, 'index']);
        Route::post('/', [RoleController::class, 'store']);
        Route::get('/{id}', [RoleController::class, 'show']);
        Route::put('/{id}', [RoleController::class, 'update']);
        Route::delete('/{id}', [RoleController::class, 'destroy']);
    });

    Route::group(['prefix' => 'user'], function(){
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'store']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
        Route::get('/search/{username}', [UserController::class, 'search']);
    });
    
    
    Route::group(['prefix' => 'office'], function(){
        Route::get('/', [OfficeController::class, 'index']);
        Route::post('/', [OfficeController::class, 'store']);
        Route::get('/{id}', [OfficeController::class, 'show']);
        Route::put('/{id}', [OfficeController::class, 'update']);
        Route::delete('/{id}', [OfficeController::class, 'destroy']);
        Route::get('/search/{office_name}', [OfficeController::class, 'search']);
        
    });
    
    Route::group(['prefix' => 'file'], function(){
        Route::get('/check-nas', [FileController::class, 'check_nas']);
        Route::get('/', [FileController::class, 'index']);
        Route::post('/', [FileController::class, 'store']);
        Route::get('/{id}', [FileController::class, 'show']);
        Route::put('/{id}', [FileController::class, 'update']);
        Route::delete('/{id}', [FileController::class, 'destroy']);
        Route::get('/file-download/{id}', [FileController::class, 'download']);
        Route::get('/search/{file_name}', [FileController::class, 'search']);
    });
});

Route::get('/test', function(){
    return env('NAS_PATH');
});




