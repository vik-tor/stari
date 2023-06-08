<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AppController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\NotebookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [AppController::class, 'index'])->name('app');

Route::post('/import', [AppController::class, 'parse'])->name('import');

Route::resource('notebooks', NotebookController::class)->only('store', 'update', 'destroy');
Route::resource('categories', NotebookCategoryController::class)->only('store', 'update', 'destroy');
Route::resource('entries', EntryController::class)->only('store', 'update', 'destroy');
Route::resource('tags', TagController::class)->only('store', 'update', 'destroy');

/* Route::post('/notebook', [NotebookController::class, 'store'])->name('notebook.store');
Route::patch('/notebook', [NotebookController::class, 'update'])->name('notebook.update');
Route::delete('/notebook', [NotebookController::class, 'destroy'])->name('notebook.destroy');

Route::post('/entry', [EntryController::class, 'store'])->name('entry.store');
Route::patch('/entry', [EntryController::class, 'update'])->name('entry.update');
Route::delete('/entry', [EntryController::class, 'destroy'])->name('entry.destroy');

Route::post('/tag', [TagController::class, 'store'])->name('tag.store');
Route::patch('/tag', [TagController::class, 'update'])->name('tag.update');
Route::delete('/tag', [TagController::class, 'destroy'])->name('tag.destroy'); */
