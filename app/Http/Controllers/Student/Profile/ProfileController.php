<?php

namespace App\Http\Controllers\Student\Profile;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    //عرض الصفحة الرئيسية للملف الشخصي

    public function index()
    {
        try {

            $student_id = Auth::guard('student')->user()->id;
            $students = Student::where('id', $student_id)->first();
            return view('Student/Profile/index', compact('students'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //تحديث البيانات الشخصية الخاصة بالطالب

    public function personal_update($id, Request $request)
    {
        try {

            $student = Student::findorfail($id);
            $student->update([
                'name' => $request->input('name'),
                'birthday' => $request->input('birthday'),
            ]);

            return redirect()->back()->with('success_message', 'The Data Updated Successfully');
        } catch (\Exception $ex) {
            return redirect()->back()->with('success_message', 'Somthing Wrong Please Try Again');
        }
    }

    //اعادة تعيين كلمة المرور للطالب

    public function reset_password($id, Request $request)
    {

        try {

            $student = Student::find($id);

            // Validate the form data
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:6',
                'confirm_new_password' => 'required|same:new_password',
            ]);

            // Check if the current password matches the student's password
            if (Hash::check($request->current_password, $student->password)) {
                // Update the student's password with the new password
                $student->password = Hash::make($request->new_password);
                $student->save();

                // Redirect the user with a success message
                return redirect()->back()->with('success_message', 'Password updated successfully.');
            } else {
                // Redirect the user back with an error message
                return redirect()->back()->with('error_message', 'Incorrect current password.');
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('success_message', 'Somthing Wrong Please Try Again');
        }
    }

    //تحديث البيانات الخاصة بالتواصل كالرقم والبريد

    public function contact_update($id, Request $request)
    {
        try {

            $student = Student::findorfail($id);
            $student->update([
                'phone' => $request->input('phone'),

            ]);

            return redirect()->back()->with('success_message', 'The Data Updated Successfully');
        } catch (\Exception $ex) {
            return redirect()->back()->with('success_message', 'Somthing Wrong Please Try Again');
        }
    }
}
