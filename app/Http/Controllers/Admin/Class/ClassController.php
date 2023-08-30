<?php

namespace App\Http\Controllers\Admin\Class;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    //عرض جدول الصفوف 

    public function index()
    {
        try {
            $adminDetails = [];
            $classes = Classe::all();
            foreach($classes as $class)
            {
                $admin_id = $class->created_by;
                $admin_name = Admin::where('id',$admin_id)->value('name');
                $adminDetails[$class->id] = $admin_name;

            }
            return view('Admin/Class/index', compact('classes' , 'adminDetails'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //عرض صفحة انشاء صف
    public function create()
    {
        try {

            return view('Admin/Class/create');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //تخزين صف في قاعدة البيانات 

    public function store(Request $request)
    {
        try {

            Classe::create([
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'created_by' => Auth::guard('admin')->user()->id,

            ]);

            return redirect()->back()->with('store_success_message', 'Class Added Successfully');
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }
}
