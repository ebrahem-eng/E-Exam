<?php

namespace App\Http\Controllers\Teacher\Exam;

use App\Http\Controllers\Controller;
use App\Models\Class_Teacher;
use App\Models\classe_subject;
use App\Models\Exam;
use App\Models\Exam_Question;
use App\Models\Question;
use App\Models\Student;
use App\Models\student_exam;
use App\Models\Subject;
use App\Models\Subject_Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamManageController extends Controller
{
    //عرض المواد الخاصة بالمدرس
    public function index()
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
            $subjects_in_classes_id = classe_subject::whereIn('class_id', $teacher_classes_id)->pluck('subject_id');

            // Get all subjects taught in the classes taught by the teacher
            $subjects_in_classes = Subject::whereIn('id', $subjects_in_classes_id)->get();

            // Combine the two sets of subjects
            $subjects = $teacher_subjects->merge($subjects_in_classes)->unique();

            return view('Teacher/Exam/Subject/subject', compact('subjects'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }


    //عرض الامتحانات الخاصة بالمدرس والمادة 

    public function exams_subject(Request $request)
    {

        try {

            $teacher_id = Auth::guard('teacher')->user()->id;
            $subject_id = $request->input('subject_id');

            $exams = DB::select("SELECT exams.id AS exam_id, exams.title AS exam_name, exams.time AS exam_time,
                    exams.number_question AS number_question, exams.mark AS exam_mark, exams.status AS exam_status,
                    teachers.name AS teacher_name , exams.created_at AS created_at FROM exams
                    INNER JOIN teachers ON exams.teacher_id = teachers.id
                    WHERE exams.subject_id = $subject_id AND exams.teacher_id = $teacher_id");


            return view('Teacher/Exam/Subject/Exam/exam_subject', compact('exams'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض الطلاب الذين قامو بتقديم امتحان معين

    public function exams_student(Request $request)
    {
        try {

            $exam_id = $request->input('exam_id');
            $student_id = student_exam::where('exam_id', $exam_id)->pluck('student_id');
            $students = Student::whereIn('id', $student_id)->get();
            $exam_submission_date = student_exam::whereIn('student_id', $student_id)
            ->where('exam_id', $exam_id)
            ->pluck('created_at');

            $exam_time_submit = student_exam::whereIn('student_id', $student_id)
            ->where('exam_id', $exam_id)
            ->pluck('time_on_exam');

            return view('Teacher/Exam/Subject/Exam/student_exam', compact('students', 'exam_id' ,'exam_submission_date' , 'exam_time_submit'));
        } catch (\Exception) {
            return redirect()->route('notfound');
        }
    }

    //عرض اجابات الطلاب

    public function exam_student_answer(Request $request)
    {

        try {

            $exam_id = $request->input('exam_id');
            $question_ids = Exam_Question::where('exam_id', $exam_id)->pluck('question_id');
            $questions = Question::whereIn('id', $question_ids)->get();
            // $student_id = Auth::guard('student')->user()->id;
            $student_id = $request->input('student_id');
            $exam_mark = Exam::where('id', $exam_id)->value('mark');
            $exam_student = student_exam::where('student_id', $student_id)->where('exam_id', $exam_id)->get();


            return view('Teacher/Exam/Subject/Exam/student_exam_answer', compact('questions', 'exam_id', 'exam_student', 'exam_mark'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }
}
