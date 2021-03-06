<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonasController;
use App\Http\Controllers\DomicilioController;

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
Route::prefix('personas')->group(function(){
Route::put('/crear',[PersonasController::class,'crear']);

Route::delete('/borrar/{id}',[PersonasController::class,'borrar']);
Route::post('/editar/{id}',[PersonasController::class,'editar']);
Route::get('/listar',[PersonasController::class,'listar']);
Route::get('/ver/{id}',[PersonasController::class,'ver']);

});

Route::prefix('domicilio')->group(function(){
    Route::put('/crear',[DomicilioController::class,'crear']);
    Route::post('/editar/{id}',[DomicilioController::class,'editar']);
    Route::get('/ver/{id}',[DomicilioController::class,'ver']);
    
    });//Tonto el que lo lea