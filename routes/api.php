<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CategoryController;

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
Route::get('get-auth-user',[AuthController::class, 'get_auth_user']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    /* Route::get('user', [UserAuthController::class, 'user']); */
    Route::get('/authenticated', function (){
        return true;
    });
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/category',[CategoryController::class, 'index']);
    Route::post('/category/store',[CategoryController::class, 'store']);
    Route::put('/category/update/{category}',[CategoryController::class, 'update']);
    Route::delete('/category/delete/{category}',[CategoryController::class, 'destroy']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/task',[TaskController::class, 'index']);
    Route::get('/task/{id}',[TaskController::class, 'filter']);
    Route::post('/task/store',[TaskController::class, 'store']);
    Route::put('/task/update/{task}',[TaskController::class, 'update']);
    Route::delete('/task/delete/{task}',[TaskController::class, 'destroy']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


