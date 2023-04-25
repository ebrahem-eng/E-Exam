<?php

namespace App\Http\Controllers\Teacher\Class;

use App\Http\Controllers\Controller;
use App\Models\Class_Teacher;
use App\Models\Classe;
use App\Models\classe_subject;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{

    //عرض صفحة الصفوف الخاصة بالمدرس

    public function index()
    {
        try {

            $id = Auth::guard('teacher')->user()->id;

            $classes_id = Class_Teacher::where('teacher_id', $id)->pluck('class_id');

            $classes = Classe::whereIn('id', $classes_id)->get();

            return view('Teacher/Class/index', compact('classes'));
        } catch (\Exception $ex) {

            return redirect()->route('notfound');
        }
    }
}
