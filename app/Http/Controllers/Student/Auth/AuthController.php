<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
     //التحقق من عملية تسجيل الدخول
 
     public function login_check(Request $request)
     {
         try {
             $check = $request->all();
             if (Auth::guard('student')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
                 return redirect()->route('student.dashboard');
             } else {
                 return redirect()->route('index');
             }
         } catch (\Exception $ex) {
             return redirect()->route('notfound');
         }
     }
 
 
     //تسجيل الخروج
 
     public function logout()
     {
         try {
             Auth::guard('student')->logout();
             return redirect()->route('index');
         } catch (\Exception $ex) {
             return redirect()->route('notfound');
         }
     }

}
