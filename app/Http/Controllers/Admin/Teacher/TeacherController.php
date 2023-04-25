<?php

namespace App\Http\Controllers\Admin\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    //عرض جدول المدرسين 

    public function index()
    {
        try {
            $teachers = Teacher::all();
            return view('Admin/Teacher/index', compact('teachers'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //اضافة مدرس 

    public function create()
    {
        try {
            return view('Admin/Teacher/create');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //تخزين المدرس في قاعدة البيانات 

    public function store(Request $request)
    {

        try {
            $password = $request->password;

            Teacher::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'gender' =>  $request->input('gender'),
                'birthday' => $request->input('birthday'),
                'image' => $request->input('image'),
                'password' => Hash::make($password),
                'created_by' => Auth::guard('admin')->user()->id,

            ]);

            return redirect()->back()->with('store_success_message', 'Teacher Added Successfully');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }
}
