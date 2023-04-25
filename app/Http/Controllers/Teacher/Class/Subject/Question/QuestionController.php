<?php

namespace App\Http\Controllers\Teacher\Class\Subject\Question;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //عرض صفحة اضافة سؤال

    public function question_subject(Request $request)
    {
        try {
            $subject_id = $request->input('subject_id');
            return view('Teacher/Class/Question/Add_Question', compact('subject_id'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض الصفحة الثانية من اضافة السؤال وهي اختيار الاجابة الصحيحة للسؤال 

    public function question2_subject(Request $request)
    {
        try {

            $numberOfOptions = $request->input('number_of_options');
            $name = $request->input('name');
            $description = $request->input('description');
            $mark = $request->input('mark');
            $subject_id = $request->input('subject_id');


            $answers = [];
            for ($i = 1; $i <= $numberOfOptions; $i++) {
                $answer = request("answer_$i");
                $answers[] = $answer;
            }


            return view('Teacher/Class/Question/Add_Question2', compact('numberOfOptions', 'answers', 'name', 'description', 'mark', 'subject_id'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض الصفحة الثالثة وهي صفحة الانتهاء نقوم. بتخزين السؤال في جدول الاسئلة

    public function question3_subject(Request $request)
    {


        try {
            // $answers = $request->input('answers');
            $true_answer =  $request->input('answer');
            // $all_answer = $request->input('all_answer');
            // $all_answer_str = implode(',', $all_answer);
            $name = $request->input('name');
            $description = $request->input('description');
            $mark = $request->input('mark');
            $subject_id = $request->input('subject_id');

            $all_answer = $request->input('all_answer');

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


            return view('Teacher/Class/Question/Add_Question3', compact('question_id', 'subject_id'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //الضغط على زر الانتهاء وتخزين السؤال والمادة في الجدول الثالث
    public function question4_subject(Request $request)
    {
        try {
            $question_id = $request->input('question_id');
            $subject_id = $request->input('subject_id');

            $subject = Subject::find($subject_id);

            if (!$subject) {
                return redirect()->route('notfound');
            }

            // Check if the question already exists in the subject's 
            if ($subject->questions()->wherePivot('question_id', $question_id)->exists()) {
                return redirect()->back()->with('store_error_message', 'Question already exists for subject');
            }
            
            $subject->questions()->attach($question_id);
            return redirect()->route('teacher.dashboard')->with('store_success_message', 'Question added successfully for Subject');

        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }
}
