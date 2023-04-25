<?php

namespace App\Http\Controllers\Admin\Subject;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
        //عرض جدول الصفوف 

        public function index()
        {
            try {
                $subjects = Subject::all();
                return view('Admin/Subject/index', compact('subjects'));
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
