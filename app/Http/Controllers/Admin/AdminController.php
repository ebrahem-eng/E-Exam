<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //عرض الصفحة الرئيسية للمدير
    public function index()
    {
        try {
            $student_count = Student::get()->count();
            $teacher_count = Teacher::get()->count();
            $class_count = Classe::get()->count();
            $subject_count = Subject::get()->count();

            return view('Admin/index' , compact('student_count' , 'teacher_count' , 'class_count' , 'subject_count'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

}
