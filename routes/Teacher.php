<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Teacher\Class\ClassController;
use App\Http\Controllers\Teacher\Class\Subject\Question\QuestionController;
use App\Http\Controllers\Teacher\Class\Subject\SubjectController;
use App\Http\Controllers\Teacher\Subject\SubjectController as SubjectSubjectController;
use App\Http\Controllers\Teacher\TeacherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Teacher routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "Teacher" middleware group. Make something great!
|
*/

//=================== Auth Route ==============
Route::get('teacher/login', [TeacherController::class, 'login_page'])->name('teacher.login.page');
Route::post('teacher/login/check', [TeacherController::class, 'login_check'])->name('teacher.login.check');



Route::middleware(['teacher'])->name('teacher.')->prefix('teacher')->group(function () {
    Route::get('/dashboard', [TeacherController::class, 'index'])->name('dashboard');
    Route::get('/logout', [TeacherController::class, 'logout'])->name('logout');

    //=================class route==========================
    Route::get('/class', [ClassController::class, 'index'])->name('class.index');

    //===============subject in class route ===================

    Route::get('/class/subject', [SubjectController::class, 'subject_in_class'])->name('class.subject');



    //========================subjects route =========================

    Route::get('/subject', [SubjectSubjectController::class, 'index'])->name('subject.index');

    //===================== question in subject route =============
    Route::get('/class/subject/question', [QuestionController::class, 'question_subject'])->name('question.subject');
    Route::get('/2/class/subject/question', [QuestionController::class, 'question2_subject'])->name('question2.subject');
    Route::post('/3/class/subject/question', [QuestionController::class, 'question3_subject'])->name('question3.subject');
    Route::post('/4/class/subject/question', [QuestionController::class, 'question4_subject'])->name('question4.subject');
});
