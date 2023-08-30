<?php

namespace App\Http\Controllers\Admin\Subject;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
        //عرض جدول الصفوف 

        public function index()
        {
            try {
                $adminDetails = [];
                $subjects = Subject::all();
                 foreach($subjects as $subject)
                {
                    $admin_id = $subject->created_by;
                    $admin_name = Admin::where('id',$admin_id)->value('name');
                    $adminDetails[$subject->id] = $admin_name;
    
                }
                return view('Admin/Subject/index', compact('subjects' , 'adminDetails'));
            } catch (\Exception $ex) {
                return redirect()->route('notfound');
            }
        }
    
        //عرض صفحة انشاء مادة
        public function create()
        {
            try {
    
                return view('Admin/Subject/create');
            } catch (\Exception $ex) {
                return redirect()->route('notfound');
            }
        }
    
        //تخزين مادة في قاعدة البيانات 
    
        public function store(Request $request)
        {
            try {
    
                Subject::create([
                    'name' => $request->input('name'),
                    'code' => $request->input('code'),
                    'created_by' => Auth::guard('admin')->user()->id,
    
                ]);
    
                return redirect()->back()->with('store_success_message', 'Subject Added Successfully');
            } catch (\Exception $ex) {
                return redirect()->route('notfound');
            }
        }
}
