<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
       //عرض صفحة تسجيل الدخول للمدير 

       public function login_page()
       {
           try {
               return view('Admin/Auth/login');
           } catch (\Exception $ex) {
               return redirect()->route('notfound');
           }
       }
   
       //التحقق من عملية تسجيل الدخول
   
       public function login_check(Request $request)
       {
           try {
               $check = $request->all();
               if (Auth::guard('admin')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
                   return redirect()->route('admin.dashboard');
               } else {
                   return redirect()->route('admin.login.page');
               }
           } catch (\Exception $ex) {
               return redirect()->route('notfound');
           }
       }
   
   
       //تسجيل الخروج
   
       public function logout()
       {
           try {
               Auth::guard('admin')->logout();
               return redirect()->route('admin.login.page');
           } catch (\Exception $ex) {
               return redirect()->route('notfound');
           }
       }
}
