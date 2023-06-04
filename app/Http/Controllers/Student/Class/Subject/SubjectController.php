<?php

namespace App\Http\Controllers\Student\Class\Subject;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\student_exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    //عرض الامتحانات داخل المادة

    public function new_exam_in_subject(Request $request)
    {

        $subject_id = $request->input('subject_id');

        $exams = DB::select("SELECT exams.id AS exam_id, exams.title AS exam_name, exams.time AS exam_time,
                exams.number_question AS number_question, exams.mark AS exam_mark, exams.status AS exam_status,
                teachers.name AS teacher_name FROM exams
                INNER JOIN teachers ON exams.teacher_id = teachers.id
                WHERE exams.subject_id = $subject_id");
        

        return view('Student/Class/Subject/Exam/exam' , compact('exams'));
    }

    //عرض الامتحانات التي قام الطالب بتقديمها

    public function my_exam_subject(Request $request)
    {

        $subject_id = $request->input('subject_id');
        $exam_ids = Exam::where('subject_id', $subject_id)->pluck('id');
        $student_id = Auth::guard('student')->user()->id;
        
        $exam_students = student_exam::where('student_id', $student_id)->whereIn('exam_id', $exam_ids)->get();
        
        $exam_student_ids = $exam_students->pluck('exam_id')->toArray();
        
        $exams = DB::table('exams')
            ->select('exams.id AS exam_id', 'exams.title AS exam_name', 'exams.time AS exam_time', 'exams.number_question AS number_question', 'exams.mark AS exam_mark', 'exams.status AS exam_status', 'teachers.name AS teacher_name')
            ->join('teachers', 'exams.teacher_id', '=', 'teachers.id')
            ->whereIn('exams.id', $exam_student_ids)
            ->get();
        
        return view('Student/Class/Subject/Exam/myexam' , compact('exams'));
        


    }
}
