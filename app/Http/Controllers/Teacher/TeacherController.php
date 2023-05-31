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

}
