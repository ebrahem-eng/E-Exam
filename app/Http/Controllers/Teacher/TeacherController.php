<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{

    //عرض الصفحة الرئيسية للمدرس
    public function index()
    {
        try {
            return view('Teacher/index');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض صفحة تسجيل الدخول للمدرس 

    public function login_page()
    {
        try {
            return view('Teacher/Auth/login');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //التحقق من عملية تسجيل الدخول

    public function login_check(Request $request)
    {
        try {
            $check = $request->all();
            if (Auth::guard('teacher')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
                return redirect()->route('teacher.dashboard');
            } else {
                return redirect()->route('teacher.login.page');
            }
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }


    //تسجيل الخروج

    public function logout()
    {
        try {
            Auth::guard('teacher')->logout();
            return redirect()->route('teacher.login.page');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

}
