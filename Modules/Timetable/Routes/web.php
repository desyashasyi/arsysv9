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

Route::prefix('timetable')->group(function() {
    Route::get('/schedule/planner', 'TimetableController@index_Planner')->name('timetable.schedule.planner');
    Route::get('/curriculum/planner', 'TimetableController@curriculumImport_Planner')->name('timetable.curriculum.planner');

    Route::get('/curriculum/clerk/home', 'TimetableController@curriculumImport_Clerk')->name('timetable.curriculum.clerk.home');

    Route::get('/data/academic-year', 'DataController@academicYear')->name('timetabele.data.academic-year');
    Route::post('/data/study-program', 'DataController@studyProgram')->name('timetable.data.study-program');
    Route::post('/data/study-program-second', 'DataController@studyProgramSecond')->name('timetable.data.study-program-second');
    Route::get('/timetable', 'LecturesController@presence_Faculty')->name('lectures.presence');
    Route::get('/presence/recap/{id}', 'LecturesController@presenceRecap_Faculty')->name('lectures.presence.recap');
    Route::get('/schedule/faculty/lecture', 'LecturesController@lectureSchedule_Faculty')->name('timetable.schedule.faculty.lecture');
    Route::get('/schedule/student/lecture', 'LecturesController@lectureSchedule_student')->name('timetable.schedule.student.lecture');

    Route::get('/subject/admin/home', 'TimetableController@subjectHome_Admin')->name('timetable.subject.admin.home');
    //Route::get('/schedule/admin/home', 'TimetableController@scheduleHome_Admin')->name('timetable.schedule.admin.home');
    Route::get('/schedule/admin/home', 'TimetableController@scheduleHome_Admin')->name('timetable.schedule.admin.home');
    Route::get('/fet/admin/home', 'TimetableController@fetHome_Admin')->name('timetable.fet.admin.home');

    Route::get('/schedule/admin/print/assignment-letter/{program}/{year}', 'PrintController@schedulePrintAssignmentLetter_Admin')->name('timetable.schedule.admin.print.assignment-letter');

});
