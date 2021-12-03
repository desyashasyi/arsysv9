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

Route::prefix('arsys')->group(function() {
    //Route::get('/', 'ArSysController@index')->name('arsys')->middleware('cas.auth');
    Route::get('/', 'ArSysController@indexx')->name('arsys');
    Route::get('/home', 'ArSysController@home')->name('arsys.home');


    /**
     * UTILITIES
     */
    /*Route::get('/utilities/admin/sync-faculty', 'UtilitiesController@syncFaculty')->name('arsys.utilities.admin.sync-faculty');
    Route::get('/utilities/admin/sync-student', 'UtilitiesController@syncStudent')->name('arsys.utilities.admin.sync-student');
    Route::get('/utilities/admin/research-truncate', 'UtilitiesController@researchTruncate')->name('arsys.utilities.admin.research-truncate');
    Route::get('/utilities/admin/sync-schedule', 'UtilitiesController@syncSchedule')->name('arsys.utilities.admin.sync-schedule');
    Route::get('/utilities/admin/sync-research', 'UtilitiesController@syncResearch')->name('arsys.utilities.admin.sync-research');
    Route::get('/utilities/admin/sync-research-spv', 'UtilitiesController@syncResearchSpv')->name('arsys.utilities.admin.sync-research-spv');

    Route::get('/utilities/admin/set-supervisor', 'UtilitiesController@setSupervisor')->name('arsys.utilities.admin.set-supervisor');
    Route::get('/utilities/admin/update-milestone', 'UtilitiesController@updateMilestone')->name('arsys.utilities.admin.update-milestone');
    Route::get('/utilities/admin/set-defense-presence', 'UtilitiesController@setDefensePresence')->name('arsys.utilities.admin.set-defense-presence');
    Route::get('/utilities/admin/delete-event', 'UtilitiesController@deleteEvent')->name('arsys.utilities.admin.delete-event');
    Route::get('/utilities/admin/set-event-type', 'UtilitiesController@setEventType')->name('arsys.utilities.admin.set-event-type');
    */
    Route::get('/utilities/admin/set-academic-year', 'UtilitiesController@setAcademicYear')->name('arsys.utilities.admin.set-academic-year');

    Route::get('/config/admin', 'ConfigController@home')->name('arsys.config.admin.home');

    /**
     * USER
     */
    Route::get('/user/management', 'UserController@userManagement_Admin')->name('arsys.user.management');
    Route::get('/user/refresh-login', 'UserController@refreshLogin_User')->name('arsys.user.refresh-login');
    Route::get('/user/mobile-activation', 'UserController@mobileActivation_User')->name('arsys.user.mobile-activation');


    /**
     * Data
     */

    Route::post('/data/event-session-defense', 'DataController@eventSessionDefense')->name('arsys.data.event-session-defense') ;
    Route::post('/data/event-session-seminar', 'DataController@eventSessionSeminar')->name('arsys.data.event-session-seminar') ;
    Route::post('/data/event-space', 'DataController@eventSpace')->name('arsys.data.event-space') ;
    Route::post('/data/event-type', 'DataController@eventType')->name('arsys.data.event-type') ;
    Route::post('/data/event-type-edit', 'DataController@eventTypeEdit')->name('arsys.data.event-type-edit');
    Route::post('/data/research-type', 'DataController@researchType')->name('arsys.data.research-type') ;
    Route::post('/data/study-program', 'DataController@studyProgram')->name('arsys.data.study-program') ;
    Route::post('/data/study-specialization', 'DataController@studySpecialization')->name('arsys.data.study-specialization') ;
    Route::post('/data/faculty', 'DataController@faculty')->name('arsys.data.faculty') ;
    Route::post('/data/letter-type', 'DataController@letterType')->name('arsys.data.letter-type') ;
    Route::post('/data/document-type', 'DataController@documentType')->name('arsys.data.document-type') ;

/**
     * Profile
     */
    Route::get('/profile/student', 'ProfileController@student')->name('arsys.profile.student');
    Route::get('/profile/admin/faculty-duty', 'ProfileController@facultyDuty_Admin')->name('arsys.profile.admin.faculty-duty');

    /**
     * Research
     */

    //student
    Route::get('/research/student', 'ResearchController@student')->name('arsys.research.student');
    Route::get('/research/student/create', 'ResearchController@create_Student')->name('arsys.research.student.create');
    Route::get('/research/clerk/dashboard', 'ResearchController@dashboard_Clerk')->name('arsys.research.clerk.dashboard');

    //specialization
    Route::get('/research/specialization/in-progress', 'ResearchController@inProgress_Specialization')->name('arsys.research.specialization.in-progress');
    Route::get('/research/specialization/completed', 'ResearchController@completed_Specialization')->name('arsys.research.specialization.completed');

    //Faculty
    Route::get('/research/faculty/monitoring', 'ResearchController@monitoring_Faculty')->name('arsys.research.faculty.monitoring');


    //Admin
    Route::get('/research/admin/monitoring', 'ResearchController@monitoring_Admin')->name('arsys.research.admin.monitoring');

    /**
     * Documents
     */

    Route::get('/document/clerk/application-letter', 'DocumentController@applicationLetter_Clerk')->name('arsys.document.clerk.application-letter');


    /**
     * Review
     */

    //Specialization
    Route::get('/review/specialization/new', 'ReviewController@newProposal_Specialization')->name('arsys.review.specialization.proposal.new');
    Route::get('/review/specialization/revise', 'ReviewController@reviseProposal_Specialization')->name('arsys.review.specialization.revise-proposal');
    Route::get('/review/specialization/presentation', 'ReviewController@presentationProposal_Specialization')->name('arsys.review.specialization.presentation-proposal');
    Route::get('/review/specialization/reject', 'ReviewController@rejectProposal_Specialization')->name('arsys.review.specialization.reject-proposal');

    //Faculty
    Route::get('/review/faculty/proposal', 'ReviewController@proposal_Faculty')->name('arsys.review.faculty.proposal');

    //Coordinator
    Route::get('/review/coordinator/new', 'ReviewController@newProposal_Coordinator')->name('arsys.review.coordinator.new');
    /**
     * Message
     */

    Route::get('/notification/admin/send-notification', [NotificationController::class, 'notification_Admin'])->name('arsys.notification.admin');


    /****************************
     * TIMETABLE
     ****************************
    */


    Route::get('/Timetable/admin', [AdminController::class, 'index'])->name('timetable.admin');


    /**
     * Supervise
     */
    Route::get('/supervise/faculty', 'SuperviseController@faculty')->name('arsys.supervise.faculty');

    /**
     * Event
     */

    Route::get('/event/admin', 'EventController@admin')->name('arsys.event.admin');
    Route::get('/event/admin/applicant/{id}', 'EventController@applicant_Admin')->name('arsys.event.admin.applicant');
    Route::get('/event/admin/presence/{id}', 'EventController@presence_Admin')->name('arsys.event.admin.presence');

    //student
    //Route::get('/event/student/{id}', 'EventController@student')->name('arsys.event.student');
    Route::get('/event/user', 'EventController@user')->name('arsys.event.user');
    Route::get('/event/faculty/upcoming', 'EventController@upcomingFaculty')->name('arsys.event.faculty.upcoming');

    //Program
    Route::get('/event/program/upcoming-seminar', 'EventController@upcomingSeminar_ProgramLeader')->name('arsys.event.program.upcoming-seminar');


    /**
     * Defense
     */


    //Score
    //Route::get('/score/program-leader/defense-score', 'DefenseScoreController@defenseScore_ProgramLeader')->name('arsys.score.program-leader.defense-score');
    Route::get('/defense/program/pre-defense', 'DefenseController@preDefense_ProgramLeader')->name('arsys.defense.program.pre-defense');
    Route::get('/defense/program/seminar-mark', 'DefenseController@seminarMark_ProgramLeader')->name('arsys.seminar.program.seminar-mark');
    Route::get('/defense/program/pre-defense-all', 'DefenseController@preDefenseAll_ProgramLeader')->name('arsys.defense.program.pre-defense-all');



    //program-approval
    Route::get('/defense/program/approval', 'DefenseController@defenseApproval_ProgramLeader')->name('arsys.defense.program.approval');


    //print
    Route::get('/print/admin/print-defense-assignment/{eventId}', 'PrintController@prinfDefense_Admin')->name('arsys.print.admin.print-defense-assignment');
    Route::get('/print/admin/print-defense-assignment-docx/{eventId}', 'PrintController@prinfDocxDefense_Admin')->name('arsys.print.admin.print-defense-assignment-docx');
    Route::get('/print/student/{event_id}/{applicant_id}', 'PrintController@printDefense_Student')->name('arsys.print.student.defense');
    Route::get('/print/faculty/assignment/pre-defense/{applicant_id}', 'PrintController@printAssignmentPredef_Faculty')->name('arsys.print.faculty.assignment.pre-defense');
    Route::get('/print/faculty/assignment/final-defense/{room_id}', 'PrintController@printAssignmentFinaldef_Faculty')->name('arsys.print.faculty.assignment.final-defense');
    Route::get('/print/admin/print-yudicium-letter/{eventId}/{programID}/{letterType}', 'PrintController@printYudisiumLetter_Admin')->name('arsys.event.admin.print-yudicium-letter');
    Route::get('/print/seminar/program/yudicium-report/{eventId}', 'PrintController@printYudiciumReport_Program')->name('arsys.seminar.program.yudicium-report');

    /**
     * Profile
     */
    Route::get('/profile/student', 'ProfileController@student')->name('arsys.profile.student');

    /*****************************
     * ArXivy
     *****************************
    */

    Route::get('/assignment/admin', 'ArXivController@faculty')->name('arxiv.assignment.faculty');

    /**
     * Login-logout
     */

    Route::post('/arsys/logout', 'ArSysController@logout')->name('arsys.logout');
});
