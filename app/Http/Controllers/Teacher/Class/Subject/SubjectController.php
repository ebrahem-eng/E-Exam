<?php

namespace App\Http\Controllers\Teacher\Class\Subject;

use App\Http\Controllers\Controller;
use App\Models\classe_subject;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
     //عرض صفحة المواد الموجودة داخل الصف

     public function subject_in_class(Request $request)
     {
         try {
 
             $class_id = $request->input('class_id');
 
             $subject_id = classe_subject::where('class_id', $class_id)->pluck('subject_id');
 
             $subjects = Subject::whereIn('id', $subject_id)->get();
 
             return view('Teacher/Class/subject', compact('subjects'));
         } catch (\Exception $ex) {
             return redirect()->route('notfound');
         }
     } 
 
}
