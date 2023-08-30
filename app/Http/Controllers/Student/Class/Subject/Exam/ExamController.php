<?php

namespace App\Http\Controllers\Student\Class\Subject\Exam;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Exam_Question;
use App\Models\Question;
use App\Models\Student;
use App\Models\student_exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    //عرض صفحة الاسئلة داخل الامتحان
    //الدخول لتقديم الامتحان
    public function show_question(Request $request)
    {
        try {

            $exam_id = $request->input('exam_id');
            $question_ids = Exam_Question::where('exam_id', $exam_id)->pluck('question_id');
            $questions = Question::whereIn('id', $question_ids)->get();
            $student_id = Auth::guard('student')->user()->id;
            $exam_student = student_exam::where('student_id', $student_id)->where('exam_id', $exam_id)->first();
            $exam_time = Exam::where('id', $exam_id)->value('time');

            if ($exam_student) {
                return redirect()->back()->with('error_message', 'You have already submitted this exam.');
            }

            return view('Student/Class/Subject/Exam/question', compact('questions', 'exam_id', 'student_id', 'exam_time'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }


    //تخزين اجابات الطالب في قااعدة البيانات 

    public function store_answer_question(Request $request)
    {
        try {

            $student_id = Student::find(Auth::guard('student')->user()->id);
            $exam_id = $request->input('exam_id');
            $question_answer_student = $request->input('student_answer');
            $question_answer_student_json = json_encode($question_answer_student);
            $time_on_page = $request->input('time_on_page');

            $student_id->exams()->attach($exam_id, [
                'question_answer_student' => $question_answer_student_json,
                'created_at' => now(),
                'time_on_exam' => $time_on_page,
            ]);

            return redirect()->route('student.dashboard')->with('success_message', 'Congratulations You Have Successfully Taken The Exam');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error_message', 'Somthing Wrong Please Try Again');
        }
    }


    //عرض اجابات الطالب والعلامة الخاصة به

    public function answer_exam(Request $request)
    {

        try {

            $exam_id = $request->input('exam_id');
            $question_ids = Exam_Question::where('exam_id', $exam_id)->pluck('question_id');
            $questions = Question::whereIn('id', $question_ids)->get();
            $student_id = Auth::guard('student')->user()->id;
            $exam_mark = Exam::where('id', $exam_id)->value('mark');
            $exam_student = student_exam::where('student_id', $student_id)->where('exam_id', $exam_id)->get();

            return view('Student/Class/Subject/Exam/answer_mark', compact('questions', 'exam_id', 'exam_student', 'exam_mark'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }
}
