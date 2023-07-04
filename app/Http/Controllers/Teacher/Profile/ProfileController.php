<?php

namespace App\Http\Controllers\Teacher\Profile;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{


    //عرض الصفحة الرئيسية للملف الشخصي

    public function index()
    {
        try {

            $teacher_id = Auth::guard('teacher')->user()->id;
            $teachers = Teacher::where('id', $teacher_id)->first();
            return view('Teacher/Profile/index', compact('teachers'));
        } catch (\Exception $ex) {
            return redirect()->route('notfound');
        }
    }

    //تحديث البيانات الشخصية الخاصة بالمدرس

    public function personal_update($id, Request $request)
    {
        try {

            $teacher = Teacher::findorfail($id);
            $teacher->update([
                'name' => $request->input('name'),
                'birthday' => $request->input('birthday'),
            ]);

            return redirect()->back()->with('success_message', 'The Data Updated Successfully');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error_message', 'Somthing Wrong Please Try Again');
        }
    }

    //اعادة تعيين كلمة المرور للمدرس

    public function reset_password($id, Request $request)
    {

        try {

            $teacher = Teacher::find($id);

            // Validate the form data
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:6',
                'confirm_new_password' => 'required|same:new_password',
            ]);

            // Check if the current password matches the student's password
            if (Hash::check($request->current_password, $teacher->password)) {
                // Update the student's password with the new password
                $teacher->password = Hash::make($request->new_password);
                $teacher->save();

                // Redirect the user with a success message
                return redirect()->back()->with('success_message', 'Password updated successfully.');
            } else {
                // Redirect the user back with an error message
                return redirect()->back()->with('error_message', 'Incorrect current password.');
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('error_message', 'Somthing Wrong Please Try Again');
        }
    }

    //تحديث البيانات الخاصة بالتواصل كالرقم والبريد

    public function contact_update($id, Request $request)
    {
        try {

            $teacher = Teacher::findorfail($id);
            $teacher->update([
                'phone' => $request->input('phone'),

            ]);

            return redirect()->back()->with('success_message', 'The Data Updated Successfully');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error_message', 'Somthing Wrong Please Try Again');
        }
    }
}
