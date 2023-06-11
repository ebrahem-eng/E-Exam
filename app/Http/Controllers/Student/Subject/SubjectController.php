<?php

namespace App\Http\Controllers\Student\Subject;

use App\Http\Controllers\Controller;
use App\Models\student_subject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    //عرض المواد المسجل بها الطالب خارج الصفوف

    public function index()
    {
        try{

            $student_id = Auth::guard('student')->user()->id;
            $subject_id = student_subject::where('student_id',$student_id)->pluck('subject_id'); 
    
            $subjects = Subject::whereIn('id',$subject_id)->get();
    
            return view('Student/Subject/index' , compact('subjects'));

        }catch(\Exception $ex)
        {
            return redirect()->route('notfound');
        }
    
    }
}
