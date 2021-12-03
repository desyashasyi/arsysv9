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

Route::prefix('course')->group(function() {
    Route::get('/presence/faculty/home', Modules\Course\Http\Livewire\Presence\Faculty\Home::class)->name('course.presence.faculty.home');
});
