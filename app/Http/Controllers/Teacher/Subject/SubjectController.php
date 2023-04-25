<?php

namespace App\Http\Controllers\Teacher\Subject;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Subject_Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    //عرض صفحة المواد الخاصة بالمدرس
    public function index()
    {
        try{

            $id = Auth::guard('teacher')->user()->id;

            $subjects_id = Subject_Teacher::where('teacher_id', $id)->pluck('subject_id');
    
            $subjects = Subject::whereIn('id', $subjects_id)->get();
    
            return view('Teacher/Subject/index', compact('subjects'));

        }catch(\Exception $ex)
        {
 
            return redirect()->route('notfound');
        }
       

    }
}
