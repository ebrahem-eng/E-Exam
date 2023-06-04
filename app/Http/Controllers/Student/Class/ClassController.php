<?php

namespace App\Http\Controllers\Student\Class;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\classe_subject;
use App\Models\Student_Class;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    //عرض صفحة الصفوف الخاصة بالطالب

    public function index()
    {
        try {

            $id = Auth::guard('student')->user()->id;

            $classes_id = Student_Class::where('student_id', $id)->pluck('class_id');

            $classes = Classe::whereIn('id', $classes_id)->get();

            return view('Student/Class/index', compact('classes'));
        } catch (\Exception $ex) {

            return redirect()->route('notfound');
        }
    }

     //عرض صفحة المواد الموجودة داخل الصف

     public function subject_in_class(Request $request)
     {
         try {
 
             $class_id = $request->input('class_id');
 
             $subject_id = classe_subject::where('class_id', $class_id)->pluck('subject_id');
 
             $subjects = Subject::whereIn('id', $subject_id)->get();
 
             return view('Student/Class/Subject/subject', compact('subjects'));
         } catch (\Exception $ex) {
             return redirect()->route('notfound');
         }
     } 
}
