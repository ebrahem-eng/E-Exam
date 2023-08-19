<?php

namespace App\Http\Controllers\Admin\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{

    //عرض جدول الطلاب 

    public function index()
    {
        try {
            $students = Student::all();
            return view('Admin/Student/index', compact('students'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //اضافة مدرس 

    public function create()
    {
        try {
            return view('Admin/Student/create');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //تخزين المدرس في قاعدة البيانات 

    public function store(Request $request)
    {

        try {
            $password = $request->password;

            Student::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'gender' =>  $request->input('gender'),
                'birthday' => $request->input('birthday'),
                'image' => $request->input('image'),
                'password' => Hash::make($password),
                'created_by' => Auth::guard('admin')->user()->id,

            ]);

            return redirect()->back()->with('store_success_message', 'Student Added Successfully');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }
}
