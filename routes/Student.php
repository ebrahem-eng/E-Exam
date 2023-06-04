<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\Auth\AuthController;
use App\Http\Controllers\Student\Class\ClassController as ClassClassController;
use App\Http\Controllers\Student\Class\Subject\Exam\ExamController as ExamExamController;
use App\Http\Controllers\Student\Class\Subject\SubjectController as ClassSubjectSubjectController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Teacher\Class\ClassController;
use App\Http\Controllers\Teacher\Class\Subject\Exam\ExamController;
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
// Route::get('student/login', [AuthController::class, 'login_page'])->name('student.login.page');
Route::post('student/login/check', [AuthController::class, 'login_check'])->name('student.login.check');



Route::middleware(['student'])->name('student.')->prefix('student')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    //=========================== class routes =================
    Route::get('/class' , [ClassClassController::class , 'index'])->name('class.index');


    //========================== subject in class routes ==================

    Route::get('/class/subject', [ClassClassController::class, 'subject_in_class'])->name('class.subject');

    //========================= exam in subject route =======================

    Route::get('/subject/new/exam' , [ClassSubjectSubjectController::class , 'new_exam_in_subject'])->name('class.subject.new.exam');

    //========================= join exam and show the question =======================

    Route::get('/subject/exam/question' , [ExamExamController::class , 'show_question'])->name('subject.exam.question');

    //========================= store student answer ===========================

    Route::post('/subject/exam/answer/question' , [ExamExamController::class , 'store_answer_question'])->name('subject.exam.answer.store');


    //========================= My  exams ===============================
    Route::get('/subject/my/exam' , [ClassSubjectSubjectController::class , 'my_exam_subject'])->name('subject.my.exam');

    Route::get('/subject/mark/answer/exam' , [ExamExamController::class , 'answer_exam'])->name('subject.exam.mark.answer');
});



