<?php

use App\Http\Controllers\AlbumController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[AlbumController::class,'index']);

Route::get('/create',[AlbumController::class,'create']);

Route::post('/album',[AlbumController::class,'store']);


Route::delete('/delete/{id}',[AlbumController::class,'destroy']);
Route::get('/edit/{id}',[AlbumController::class,'edit']);
Route::delete('/deletepictures/{id}',[AlbumController::class,'deletepictures']);
Route::delete('/deletepicture/{id}',[AlbumController::class,'deletepicture']);
Route::put('/update/{id}',[AlbumController::class,'update']);





