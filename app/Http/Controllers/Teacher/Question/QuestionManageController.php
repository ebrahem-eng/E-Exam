<?php

namespace App\Http\Controllers\Teacher\Question;

use App\Http\Controllers\Controller;
use App\Models\Class_Teacher;
use App\Models\classe_subject;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Subject_Question;
use App\Models\Subject_Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuestionManageController extends Controller
{
    //عرض صفحة المواد الخاصة بالمدرس

    public function show_subject()
    {

        try {

            // Get the authenticated teacher's ID
            $teacher_id = Auth::guard('teacher')->user()->id;

            // Get the IDs of all subjects taught by the teacher
            $teacher_subjects_id = Subject_Teacher::where('teacher_id', $teacher_id)->pluck('subject_id');

            // Get all subjects taught by the teacher
            $teacher_subjects = Subject::whereIn('id', $teacher_subjects_id)->get();

            // Get the IDs of all classes taught by the teacher
            $teacher_classes_id = Class_Teacher::where('teacher_id', $teacher_id)->pluck('class_id');

            // Get the IDs of all subjects in the classes taught by the teacher
            $subjects_in_classes_id = Classe_Subject::whereIn('class_id', $teacher_classes_id)->pluck('subject_id');

            // Get all subjects taught in the classes taught by the teacher
            $subjects_in_classes = Subject::whereIn('id', $subjects_in_classes_id)->get();

            // Combine the two sets of subjects
            $subjects = $teacher_subjects->merge($subjects_in_classes)->unique();

            return view('Teacher/Question/Subject/subject', compact('subjects'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض بنك الاسئلة الخاص بالمادة

    public function question_bank_subject(Request $request)
    {
        try{

            $subject_id = $request->input('subject_id');
            $question_id = Subject_Question::where('subject_id', $subject_id)->pluck('question_id');
            $question_details = Question::whereIn('id', $question_id)->get();
    
            return view('Teacher/Question/Subject/Question/question_bank', compact('question_details', 'subject_id'));

        }catch(\Exception $ex)
        {

            return redirect()->route('notfound');

        }
 
    }

    //حذف سؤال من بنك اسئلة مادة
    
    public function delete_question(Request $request)
    {
        $question_id = $request->input('question_id');
        Question::where('id' , $question_id)->delete();

        return redirect()->back()->with('success_message' , 'Question Deleted Successfully');
    }
}
