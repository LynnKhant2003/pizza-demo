<?php

use App\Models\pizzas;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\ApiController;

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


Route::group(['middleware'=>'auth:sanctum'],function(){
    Route::get('user',function(){
        return pizzas::all();
    });
});

Route::get('login',[AuthController::class,'login']);
Route::group(['namespace'=>"API",'prefix'=>"category"],function(){
    Route::get('list',[ApiController::class,'list']);
    Route::post('create',[ApiController::class,'create']);
    Route::get('details/{id}',[ApiController::class,'details']);
    Route::get('delete/{id}',[ApiController::class,'delete']);
    Route::post('update/{id}',[ApiController::class,'update']);
});
