<?php

namespace App\Http\Controllers\Admin\RelationShip;

use App\Http\Controllers\Controller;
use App\Models\Class_Teacher;
use App\Models\Classe;
use App\Models\classe_subject;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RelationShipController extends Controller
{

    //========================class function ==============
    //عرض صفحة المواد الموجودة داخل الصف

    public function subject_in_class($class_id, Request $request)
    {
        try {
            $class = Classe::find($class_id);
            $subjects = $class->subjects;
            $id = $request->input('id');
            return view('Admin/Class/subject', compact('subjects', 'id'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض صفحة اضافة مادة الى صف 

    public function create_subject_in_class(Request $request)
    {
        try {
            $class_id = $request->input('id');
            $class_name = Classe::where('id', $class_id)->value('name');
            $subjects = Subject::all();
            return view('Admin/Class/Add_Subject', compact('class_name', 'subjects', 'class_id'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //اضافة مادة الى صف في قاعدة البيانات

    public function store_subject_in_class(Request $request)
    {

        try {

            $class = Classe::find($request->input('class_id'));
            if (!$class) {
                return redirect()->route('notfound');
            }

            $subjectId = $request->input('subjectId');
            if ($class->subjects()->where('subject_id', $subjectId)->exists()) {
                return redirect()->back()->with('store_error_message', 'Subject already exists in class');
            }

            $class->subjects()->attach($subjectId);

            return redirect()->back()->with('store_success_message', 'Subject added successfully to class');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //===================end class function ===============

    //===================subject function =================

    //عرض صفحة الصفوف اللتي تنتمي لها المادة

    public function class_content_subject($subject_id, Request $request)
    {
        try {
            $subject = Subject::find($subject_id);
            $classes = $subject->classes;
            $id = $request->input('id');
            return view('Admin/Subject/class', compact('classes', 'id'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }


    //عرض صفحة اضافة المادة الى صف معين

    public function create_class_to_subject(Request $request)
    {
        try {
            $subject_id = $request->input('id');
            $subject_name = Subject::where('id', $subject_id)->value('name');
            $classes = Classe::all();

            return view('Admin/Subject/Add_Class', compact('subject_name', 'classes', 'subject_id'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //اضافة مادة الى صف معين في قاعدة البيانات

    public function store_class_to_subject(Request $request)
    {

        try {

            $subject = Subject::find($request->input('subject_id'));

            if (!$subject) {
                return redirect()->route('notfound');
            }

            $classId = $request->input('classId');

            // Check if the class already exists in the subject's list of classes
            if ($subject->classes()->wherePivot('class_id', $classId)->exists()) {
                return redirect()->back()->with('store_error_message', 'Class already exists for Subject');
            }

            $subject->classes()->attach($classId);
            return redirect()->back()->with('store_success_message', 'Class added successfully for Subject');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //=====================end subject function ================

    //======================Teacher Function ====================

    //عرض صفحة الصفوف الموجودة لدى المدرس

    public function classes_teacher($teacher_id, Request $request)
    {
        try {
            $teacher = Teacher::find($teacher_id);
            $classes = $teacher->classes;
            $id = $request->input('id');

            return view('Admin/Teacher/class', compact('classes', 'id'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض صفحة اضافة صف للمدرس

    public function create_classes_teacher(Request $request)
    {
        try {
            $teacher_id = $request->input('id');
            $teacher_name = Teacher::where('id', $teacher_id)->value('name');
            $classes = Classe::all();
            return view('Admin/Teacher/Add_Class', compact('teacher_name', 'classes', 'teacher_id'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //اضافة صف لمدرس في قاعدة البيانات

    public function store_classes_teacher(Request $request)
    {
        try {
            $teacher = Teacher::find($request->input('teacher_id'));

            if (!$teacher) {
                return redirect()->route('notfound');
            }

            $classId = $request->input('classId');

            // Check if the class already exists in the teacher's list of classes
            if ($teacher->classes()->wherePivot('class_id', $classId)->exists()) {
                return redirect()->back()->with('store_error_message', 'Class already exists for Teacher');
            }

            $teacher->classes()->attach($classId);
            return redirect()->back()->with('store_success_message', 'Class added successfully for Teacher');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }


    //عرض صفحة المواد الخاصة بالمدرس 

    public function subjects_teacher($teacher_id, Request $request)
    {
        try {
            $teacher = Teacher::find($teacher_id);
            $subjects = $teacher->subjects;
            $id = $request->input('id');

            return view('Admin/Teacher/subject', compact('subjects', 'id'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }


    //عرض صفحة اضافة مادة لمدرس 

    public function create_subjects_teacher(Request $request)
    {
        try {
            $teacher_id = $request->input('id');
            $teacher_name = Teacher::where('id', $teacher_id)->value('name');
            $subjects = Subject::all();
            return view('Admin/Teacher/Add_Subject', compact('teacher_name', 'subjects', 'teacher_id'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }


    //تخزين المادة ورقم المدرس في جدول مواد المدرس 

    public function store_subjects_teacher(Request $request)
    {
        try {
            $teacher_id = $request->input('teacher_id');
            $teacher = Teacher::find($teacher_id);
            $teacher_class_ids = Class_Teacher::where('teacher_id', $teacher_id)->pluck('class_id');
            $subject_id_in_class = classe_subject::whereIn('class_id', $teacher_class_ids)->pluck('subject_id');

            if (!$teacher) {
                return redirect()->route('notfound');
            }

            $subjectId = $request->input('subjectId');

            //التحقق ان المادة لم يتم اعطائها للمدرس وانها غير موجودة داخل الصفوف الخاصة بالمدرس

            // Check if the class already exists in the teacher's list of سعزتثذفس
            if ($teacher->subjects()->wherePivot('subject_id', $subjectId)->exists() || $subject_id_in_class->intersect($subjectId)->isNotEmpty()) {
                return redirect()->back()->with('store_error_message', 'Subject already exists for Teacher');
            }

            $teacher->subjects()->attach($subjectId);
            return redirect()->back()->with('store_success_message', 'Subject added successfully for Teacher');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }
    //================end teacher function================
}
