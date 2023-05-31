<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //عرض الصفحة الرئيسية للمدير
    public function index()
    {
        try {
            return view('Admin/index');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

}
