<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    
     //عرض الصفحة الرئيسية للطالب

     public function index()
     {
         try {
             return view('Student/index');
         } catch (\Exception $ex) {
             return redirect()->route('notfound');
         }
     }

}
