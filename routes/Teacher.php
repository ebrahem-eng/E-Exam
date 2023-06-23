<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Teacher\Auth\AuthController;
use App\Http\Controllers\Teacher\Class\ClassController;
use App\Http\Controllers\Teacher\Class\Subject\Exam\ExamController;
use App\Http\Controllers\Teacher\Class\Subject\Question\QuestionController;
use App\Http\Controllers\Teacher\Class\Subject\SubjectController;
use App\Http\Controllers\Teacher\Exam\ExamManageController;
use App\Http\Controllers\Teacher\Profile\ProfileController as ProfileProfileController;
use App\Http\Controllers\Teacher\Question\QuestionManageController;
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
Route::get('teacher/login', [AuthController::class, 'login_page'])->name('teacher.login.page');
Route::post('teacher/login/check', [AuthController::class, 'login_check'])->name('teacher.login.check');



Route::middleware(['teacher'])->name('teacher.')->prefix('teacher')->group(function () {
    Route::get('/dashboard', [TeacherController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


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


    //==================== exam choose question from bank question in subject route =================
    Route::get('/class/subject/exam', [ExamController::class, 'exam_subject'])->name('exam.subject');
    Route::get('/2/class/subject/exam', [ExamController::class, 'exam2_subject'])->name('exam2.subject');
    Route::get('/show/2/class/subject/exam', [ExamController::class, 'show_page_exam2'])->name('show.page.exam2.subject');


    //===================== show choose question from question bank ====================
    Route::get('class/subject/exam/choose/question', [ExamController::class, 'exam_subject_choose_question'])->name('exam.subject.choose.question');
    Route::get('class/subject/choose/question', [ExamController::class, 'choose_question'])->name('exam.choose.question');
    Route::get('/class/subject/finish/choose/question', [ExamController::class, 'finish_choose_question'])->name('finish.exam.choose.question');



    //========================= exam create new question route =================
    Route::get('/class/new/question/subject/exam', [ExamController::class, 'exam_subject_new_question'])->name('exam.subject.new.question');
    Route::get('2/class/new/question/subject/exam', [ExamController::class, 'exam_subject_new_question2'])->name('exam.subject.new.question2');
    Route::post('3/class/new/question/subject/exam', [ExamController::class, 'exam_subject_new_question3'])->name('exam.subject.new.question3');
    Route::post('4/class/new/question/subject/exam', [ExamController::class, 'exam_subject_new_question4'])->name('exam.subject.new.question4');


    //delete question from exam 
    Route::delete('class/subject/exam/delete/question/{id}', [ExamController::class , 'delete_question_exam'])->name('exam.question.delete');

    //============================= Question Manage ==========================

    //====================== show subject from teacher to manage ===============

    Route::get('/question/subject' , [QuestionManageController::class , 'show_subject'])->name('question.subjects');

    //=====================show question bank for subject ==================

    Route::get('/question/subject/bankQuestion' , [QuestionManageController::class ,'question_bank_subject' ])->name('question.subject.bank.subject');

    //==================== delete question from question and bank question subject ==============

    Route::delete('/question/subject/bankQuestion/delete' , [QuestionManageController::class , 'delete_question'])->name('question.subject.bank.delete');


    //=================== exam manage ================

    //show subject for teacher 

    Route::get('/exam/subject' , [ExamManageController::class , 'index'])->name('exam.subject.manage');

    //show exams in subjects 

    Route::get('/exam/subject/exams' , [ExamManageController::class , 'exams_subject'])->name('exam.subject.exam.manage');

    //show student in exam 

    Route::get('exam/subject/exam/student' , [ExamManageController::class , 'exams_student'])->name('exam.subject.exam.student');

    //show answer students 

    Route::get('exam/subject/exam/student/answer' , [ExamManageController::class , 'exam_student_answer'])->name('exam.subject.exam.student.answer');


    //===================================teacher Profile ==============================

    Route::get('/profile', [ProfileProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/personal_info/update/{id}', [ProfileProfileController::class, 'personal_update'])->name('profile.personal.update');
    Route::put('/profile/reset_password/update/{id}', [ProfileProfileController::class, 'reset_password'])->name('profile.reset.password.update');
    Route::put('/profile/contact/update/{id}', [ProfileProfileController::class, 'contact_update'])->name('profile.contact.update');


});
