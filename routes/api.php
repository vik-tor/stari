<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\NotebookCategory;
use App\Models\Notebook;

use App\Http\Controllers\EntryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\NotebookController;
use App\Http\Controllers\NotebookCategoryController;

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

Route::resource('notebooks', NotebookController::class)->only('index', 'store', 'update', 'destroy');
Route::resource('categories', NotebookCategoryController::class)->only('index', 'store', 'update', 'destroy');
Route::resource('entries', EntryController::class)->only('store', 'update', 'destroy');
Route::resource('tags', TagController::class)->only('store', 'update', 'destroy');
