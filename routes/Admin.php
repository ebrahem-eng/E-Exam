<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Class\ClassController as ClassClassController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\RelationShip\RelationShipController;
use App\Http\Controllers\Admin\Subject\SubjectController;
use App\Http\Controllers\Admin\Teacher\TeacherController as TeacherTeacherController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Teacher\TeacherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "Admin" middleware group. Make something great!
|
*/

//=================== Auth Route ==============
Route::get('admin/login', [AdminController::class, 'login_page'])->name('admin.login.page');
Route::post('admin/login/check', [AdminController::class, 'login_check'])->name('admin.login.check');



Route::middleware(['admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

    //=============class route ============
    Route::resource('/class', ClassClassController::class);
    Route::get('/class/subjects/{class_id}',[RelationShipController::class , 'subject_in_class'])->name('class.subject');
    Route::get('/create/class/subjects/',[RelationShipController::class , 'create_subject_in_class'])->name('class.subject.create');
    Route::post('/store/class/subjects/',[RelationShipController::class , 'store_subject_in_class'])->name('class.subject.store');

    //=============Subject route ============
    Route::resource('/subject', SubjectController::class);

    Route::get('/subjects/class/{subject_id}',[RelationShipController::class , 'class_content_subject'])->name('subject.class');
    Route::get('/create/subjects/class/',[RelationShipController::class , 'create_class_to_subject'])->name('subject.class.create');
    Route::post('/store/subjects/class/',[RelationShipController::class , 'store_class_to_subject'])->name('subject.class.store');


    //============= Teacher route =============
    Route::get('/teacher/teacher/class/{teacher_id}',[RelationShipController::class , 'classes_teacher'])->name('class.teacher');
    Route::get('/create/teacher/teacher/class',[RelationShipController::class , 'create_classes_teacher'])->name('create.class.teacher');
    Route::post('/store/teacher/teacher/class',[RelationShipController::class , 'store_classes_teacher'])->name('store.class.teacher');

    Route::get('/teacher/teacher/subject/{teacher_id}',[RelationShipController::class , 'subjects_teacher'])->name('subject.teacher');
    Route::get('/create/teacher/teacher/subject',[RelationShipController::class , 'create_subjects_teacher'])->name('create.subject.teacher');
    Route::post('/store/teacher/teacher/subject',[RelationShipController::class , 'store_subjects_teacher'])->name('store.subject.teacher');

    Route::resource('/teacher', TeacherTeacherController::class);
});
