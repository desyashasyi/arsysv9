<?php

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

Route::prefix('collabre')->group(function() {
    Route::get('/', \Modules\Collabre\Http\Livewire\Index::class)->name('collabre.index');
    Route::get('/todo/list/{collabre_id}', \Modules\Collabre\Http\Livewire\Todo\DirectoryIdx::class)->name('collabre.todo.directory');
    Route::get('/todo/personal/{list_id}', \Modules\Collabre\Http\Livewire\Todo\PersonalIdx::class)->name('collabre.todo.personal');
    Route::get('/todo/view/{todo_id}', \Modules\Collabre\Http\Livewire\Todo\ViewIdx::class)->name('collabre.todo.view');


});
