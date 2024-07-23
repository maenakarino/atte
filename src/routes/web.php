<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestController;

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

Route::get('/', [WorkController::class, 'index']);

Route::post('/work/start', [WorkController::class, 'start']);

Route::post('/work/end', [WorkController::class, 'end']);

Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index']);
    });

Route::post('/work/end', [WorkController::class, 'update']);

Route::post('/rest/start', [RestController::class, 'start']);
Route::post('/rest/end', [RestController::class, 'end']);
