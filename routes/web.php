<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AppController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\NotebookController;
use App\Http\Controllers\NotebookCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [AppController::class, 'index'])->name('app');

Route::post('import', [AppController::class, 'parse'])->name('import');

Route::resource('notebooks', NotebookController::class)->only('store', 'update', 'destroy');
Route::resource('categories', NotebookCategoryController::class)->only('store', 'update', 'destroy');
Route::resource('entries', EntryController::class)->only('store', 'update', 'destroy');
Route::resource('tags', TagController::class)->only('store', 'update', 'destroy');
