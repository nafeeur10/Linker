<?php

use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () { return view('index');});
Route::get('/count', [LinkController::class, 'count']);
Route::get('/search', [LinkController::class, 'search']);
Route::get('/delete', [LinkController::class, 'delete']);
Route::get('/links', [LinkController::class, 'index']);
Route::get('/create', [LinkController::class, 'create']);
Route::post('store', [LinkController::class, 'store']);
