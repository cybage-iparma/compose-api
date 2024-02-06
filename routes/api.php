<?php

use App\Http\Controllers\ContentStoreElementController;
use App\Http\Controllers\MessageTemplateController;
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

Route::post('/store-data', [MessageTemplateController::class, 'store']);
Route::get('/content-store/cs-elements', [ContentStoreElementController::class, 'index']);
Route::post('/content-store/cs-elements', [ContentStoreElementController::class, 'createContentStoreElement']);