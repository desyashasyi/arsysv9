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

Route::prefix('arxiv')->group(function() {
    //Route::get('/', 'ArXivController@index');
    /*Route::get('/asssignment/faculty/pre-defense', 'AssignmentController@preDefense_Assignment_Faculty')->name('arxiv.assignment.faculty.pre-defense');
    Route::get('/asssignment/faculty/final-defense', 'AssignmentController@finalDefense_Assignment_Faculty')->name('arxiv.assignment.faculty.final-defense');
    Route::get('/asssignment/admin/final-defense', 'AssignmentController@finalDefense_Assignment_Admin')->name('arxiv.assignment.admin.final-defense');
    Route::get('/asssignment/faculty/seminar', 'AssignmentController@seminar_Assignment_Faculty')->name('arxiv.assignment.faculty.seminar');
    Route::get('/asssignment/specialization/final-defense', 'AssignmentController@finalDefenseAssignment_specialization')->name('arxiv.assignment.specialization.final-defense');
    */

    Route::get('/asssignment/faculty/pre-defense', \Modules\ArXiv\Http\Livewire\Assignment\Faculty\PreDefenseIdx::class)->name('arxiv.assignment.faculty.pre-defense');
    Route::get('/asssignment/faculty/final-defense', \Modules\ArXiv\Http\Livewire\Assignment\Faculty\FinalDefenseIdx::class)->name('arxiv.assignment.faculty.final-defense');
    Route::get('/asssignment/admin/final-defense', \Modules\ArXiv\Http\Livewire\Assignment\Admin\FinalDefenseAdminIdx::class)->name('arxiv.assignment.admin.final-defense');
    Route::get('/asssignment/faculty/seminar', \Modules\ArXiv\Http\Livewire\Assignment\Faculty\SeminarIdx::class)->name('arxiv.assignment.faculty.seminar');
    Route::get('/asssignment/specialization/final-defense', \Modules\ArXiv\Http\Livewire\Assignment\Specialization\FinalDefenseSpecializationIdx::class)->name('arxiv.assignment.specialization.final-defense');
    Route::get('/asssignment/faculty/lecture', \Modules\ArXiv\Http\Livewire\Assignment\Faculty\LectureIdx::class)->name('arxiv.assignment.faculty.lecture');
    Route::get('/asssignment/admin/lecture', \Modules\ArXiv\Http\Livewire\Assignment\Admin\LectureIdx::class)->name('arxiv.assignment.admin.lecture');
    Route::get('/asssignment/faculty/supervision', \Modules\ArXiv\Http\Livewire\Assignment\Faculty\SupervisionIdx::class)->name('arxiv.assignment.faculty.supervision');

});
