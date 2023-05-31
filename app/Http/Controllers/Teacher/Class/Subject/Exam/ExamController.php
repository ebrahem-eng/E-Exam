<?php

namespace App\Http\Controllers\Teacher\Class\Subject\Exam;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Exam_Question;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Subject_Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{

    //عرض صفحة اضافة امتحان
    public function exam_subject(Request $request)
    {
        $subject_id = $request->input('subject_id');
        return view('Teacher/Class/Exam/Add_exam', compact('subject_id'));
    }

    //تخزين بيانات الامتحان في قاعدة البيانات ثم الانتقال الى صفحة اختيار الاسئلة 

    public function exam2_subject(Request $request)
    {
        $exam_title = $request->input('title_exam');
        $exam_mark = $request->input('mark_exam');
        $time_exam = $request->input('time_exam');
        $status_exam = $request->input('status_exam');
        $number_questions = $request->input('number_question');
        $subject_id = $request->input('subject_id');
        $teacher_id = Auth::guard('teacher')->user()->id;

        $exam = Exam::create([
            'title' => $exam_title,
            'time' => $time_exam,
            'number_question' => $number_questions,
            'mark' => $exam_mark,
            'status' => $status_exam,
            'subject_id' => $subject_id,
            'teacher_id' => $teacher_id,
        ]);

        $exam_id = $exam->id;
        $question_ids = Exam_Question::where('exam_id', $exam_id)->pluck('question_id');
        $question_details = Question::whereIn('id', $question_ids)->get();

        return redirect()->route('teacher.show.page.exam2.subject', compact('question_details', 'exam_title', 'exam_mark', 'time_exam', 'status_exam', 'number_questions', 'subject_id', 'exam_id'));
    }

    //عرض صفحة اختيار سؤال واستعراض الاسئلة الخاصة بالامتحان 

    public function show_page_exam2(Request $request)
    {

        // $question_details = $request->input('question_details');

        $exam_title = $request->input('exam_title');
        $exam_mark = $request->input('exam_mark');
        $time_exam = $request->input('time_exam');
        $status_exam = $request->input('status_exam');
        $number_questions = $request->input('number_questions');
        $subject_id = $request->input('subject_id');
        $exam_id = $request->input('exam_id');

        $question_ids = Exam_Question::where('exam_id', $exam_id)->pluck('question_id');
        $question_details = Question::whereIn('id', $question_ids)->get();

        return view('Teacher.Class.Exam.Add_exam2', compact('question_details', 'exam_title', 'exam_mark', 'time_exam', 'status_exam', 'number_questions', 'subject_id', 'exam_id'));
    }



    // عرض صفحة اختيار سؤال من بنك اسئلة المادة  والتحقق اذا كان تم تجاوز عدد الاسئلة المحدد للامتحان

    public function exam_subject_choose_question(Request $request)
    {
        $subject_id = $request->input('subject_id');
        $exam_id = $request->input('exam_id');
        $exam_question_number = $request->input('exam_question_number');
        $question_id = Subject_Question::where('subject_id', $subject_id)->pluck('question_id');
        $question_details = Question::whereIn('id', $question_id)->get();
        $number_questions = $request->input('number_question');

        $exam_questions_count = Exam_Question::where('exam_id', $exam_id)->count();

        if ($exam_questions_count < $number_questions) {
            return view('Teacher/Class/Exam/question_bank', compact('question_details', 'subject_id', 'exam_id', 'exam_question_number', 'number_questions'));
        } else {
            return redirect()->back()->with('error_message', 'You have reached the maximum number of questions');
        }
    }


    //  ااختيار السؤال من بنك اسئلة المادة ثم العودة لصفحة اختيار سؤال واستعراض الاسئلة 

    public function choose_question(Request $request)
    {
        $exam_id = $request->input('exam_id');
        $subject_id = $request->input('subject_id');
        $question_id = $request->input('question_id');
        $number_questions = $request->input('number_question');


        // Exam_Question::create([
        //     'exam_id' => $exam_id,
        //     'question_id' => $question_id,
        // ]);
        $exam = Exam::find($exam_id);

        if (!$exam) {
            return redirect()->route('notfound');
        }

        $exam->questions()->attach($question_id);

        $question_ids = Exam_Question::where('exam_id', $exam_id)->pluck('question_id');
        $question_details = Question::whereIn('id', $question_ids)->get();

        return redirect()->route('teacher.show.page.exam2.subject', compact('question_details', 'number_questions', 'subject_id', 'exam_id'));
    }


    //الانتهاء من انشاء الامتحان والذهاب للصفحة الرئيسية

    public function finish_choose_question()
    {
        return redirect()->route('teacher.dashboard')->with('store_success_message', 'The Exam Created Successfully');
    }

    // عرض صفحة انشاء سؤال جديد والتحقق اذا كان تم تجاوز عدد الاسئلة المحدد للامتحان

    public function exam_subject_new_question(Request $request)
    {
        $subject_id = $request->input('subject_id');
        $exam_id = $request->input('exam_id');
        $number_questions = $request->input('number_question');

        $exam_questions_count = Exam_Question::where('exam_id', $exam_id)->count();

        if ($exam_questions_count < $number_questions) {
            return view('Teacher/Class/Exam/New_Question/new_question', compact('subject_id', 'exam_id', 'number_questions'));
        } else {
            return redirect()->back()->with('error_message', 'You have reached the maximum number of questions');
        }
    }

    //عرض الصفحة الثانية من اضافة سؤال جديد

    public function exam_subject_new_question2(Request $request)
    {

        $numberOfOptions = $request->input('number_of_options');
        $name = $request->input('name');
        $description = $request->input('description');
        $mark = $request->input('mark');
        $subject_id = $request->input('subject_id');
        $exam_id = $request->input('exam_id');
        $number_questions = $request->input('number_question');

        $answers = [];
        for ($i = 1; $i <= $numberOfOptions; $i++) {
            $answer = request("answer_$i");
            $answers[] = $answer;
        }


        return view('Teacher/Class/Exam/New_Question/new_question2', compact('numberOfOptions', 'answers', 'name', 'description', 'mark', 'subject_id', 'exam_id', 'number_questions'));
    }

    //عرض الصفحة الثالثة من اضافة سؤال جديد

    public function exam_subject_new_question3(Request $request)
    {

        $true_answer =  $request->input('answer');
        $name = $request->input('name');
        $description = $request->input('description');
        $mark = $request->input('mark');
        $subject_id = $request->input('subject_id');

        $all_answer = $request->input('all_answer');
        $exam_id = $request->input('exam_id');
        $number_questions = $request->input('number_question');

        $answers = [];
        foreach ($all_answer as $answer) {
            $parts = explode(':', $answer);
            $id = $parts[0];
            $value = $parts[1];
            $answers[$id] = $value;
        }

        // check if question previously existed based on name and description
        $existing_question = Question::where('name', $name)->first();

        if ($existing_question) {
            // return error message if question already exists
            return redirect()->back()->with('store_error_message', 'The Question Actually exists ');
        }

        $question = Question::create([
            'name' => $name,
            'description' => $description,
            'mark' => $mark,
            'true_answer' => $true_answer,
            'answer' => json_encode($answers),
        ]);

        $question_id = $question->id;


        return view('Teacher/Class/Exam/New_Question/new_question3', compact('question_id', 'subject_id', 'exam_id', 'number_questions'));
    }


    //تخزين السؤال الجديد في بنك اسئلة المادة وتخزينه في اسئلة الامتحان والعودة لصفحة اختيار الاسئلة

    public function exam_subject_new_question4(Request $request)
    {
        $question_id = $request->input('question_id');
        $subject_id = $request->input('subject_id');
        $exam_id = $request->input('exam_id');
        $number_questions = $request->input('number_question');

        $subject = Subject::find($subject_id);
        $exam = Exam::find($exam_id);

        if (!$subject) {
            return redirect()->route('notfound');
        }

        // Check if the question already exists in the subject's 
        if ($subject->questions()->wherePivot('question_id', $question_id)->exists()) {
            return redirect()->back()->with('store_error_message', 'Question already exists for subject');
        }

        $subject->questions()->attach($question_id);

        // Exam_Question::create([
        //     'exam_id' => $exam_id,
        //     'question_id' => $question_id,
        // ]);


        if (!$exam) {
            return redirect()->route('notfound');
        }

        $exam->questions()->attach($question_id);

        $question_ids = Exam_Question::where('exam_id', $exam_id)->pluck('question_id');
        $question_details = Question::whereIn('id', $question_ids)->get();

        return redirect()->route('teacher.show.page.exam2.subject', compact('question_details', 'number_questions', 'subject_id', 'exam_id'));
    }

    //حذف سؤال من الامتحان اثناء انشاؤه

    public function delete_question_exam($id)
    {
        Exam_Question::where('question_id', $id)->delete();
        return redirect()->back()->with('success_message', 'Question Deleted Successfully');
    }
}
