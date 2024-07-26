<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\ClassModel;

class UserController extends Controller
{
    //
    public function change_password(){
        return view('profile.change_password');
    }

    public function update_change_password(Request $request){
        $user = User::getSingle(Auth::user()->id);
        if(Hash::check($request->old_password,$user->password))
        {
            $user-> password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with('success','Password Successfully Changed.');
        }
        else
        {
            return redirect()->back()->with('error','Old password is incorrect.');
        }
    }
    
    public function MyAccount(){
        $data['getRecord'] = User::getSingle(Auth::User()->id);
        if (Auth::user()->role == 'admin'){
            return view('admin.admin.my_account',$data);
        }
        else if (Auth::user()->role =='student'){
            $data['getClass'] = ClassModel::getClass();
            return view('student.my_account',$data);
        }
        else if (Auth::user()->role =='teacher'){
            return view('teacher.my_account',$data);
        }
        else if (Auth::user()->role=='parent'){
            return view('parent.my_account',$data);
        }
    }

    public function UpdateAccountAdmin(Request $request){
        $id = Auth::user()->id;
    request()->validate([
        'email' => 'required|email|unique:users,email,'.$id,
        'mobile_number' => 'max:15|min:10',

    ]);
    
    $admin = User::getSingle($id);
    if(!empty($request->file('profile_picture')))
    {
        $ext = $request->file('profile_picture')->getClientOriginalExtension();
        $file = $request->file('profile_picture');
        $randomStr = str()->random(20);
        $filename = strtolower($randomStr).'.'.$ext;
        $file->move('upload/profile/', $filename);

        $admin -> profile_picture = $filename;
    } 
        $admin-> name = trim($request->name);
        $admin-> last_name = trim($request->last_name);
        $admin-> mobile_number = trim($request-> mobile_number);
        $admin-> email = trim($request->email);
        $admin-> save();

    return redirect()->back()->with('success','Profile Successfully Updated');
}

public function UpdateAccountStudent(Request $request){
    $id = Auth::user()->id;
    request()->validate([
        'email' => 'required|email|unique:users,email,'.$id,
        'mobile_number' => 'max:15|min:10',

    ]);
    
    $student = User::getSingle($id);
    if(!empty($request->file('profile_picture')))
    {
        $ext = $request->file('profile_picture')->getClientOriginalExtension();
        $file = $request->file('profile_picture');
        $randomStr = str()->random(20);
        $filename = strtolower($randomStr).'.'.$ext;
        $file->move('upload/profile/', $filename);

        $student -> profile_picture = $filename;
    } 
        $student-> name = trim($request->name);
        $student-> last_name = trim($request->last_name);
        $student-> gender = trim($request->gender);
        $student-> date_of_birth = trim($request->date_of_birth);
        $student-> blood_group = trim($request->blood_group);
        $student-> height = trim($request->height);
        $student-> weight = trim($request->weight);
        $student-> admission_number = trim($request->admission_number);
        $student-> admission_date = trim($request->admission_date);
        $student-> roll_number = trim($request->roll_number);
        $student-> class_id = trim($request-> class_id);
        $student-> caste = trim($request->caste);
        $student-> religion = trim($request->religion);
        $student-> status = trim($request->status);
        $student-> mobile_number = trim($request->mobile_number);
        $student-> email = trim($request->email);
        $student-> save();

    return redirect()->back()->with('success','Profile Successfully Updated');
}

    public function UpdateAccountParent(Request $request){
        $id = Auth::user()->id;
    request()->validate([
        'email' => 'required|email|unique:users,email,'.$id,
        'mobile_number' => 'max:15|min:10',

    ]);
    
    $parent = User::getSingle($id);
    if(!empty($request->file('profile_picture')))
    {
        $ext = $request->file('profile_picture')->getClientOriginalExtension();
        $file = $request->file('profile_picture');
        $randomStr = str()->random(20);
        $filename = strtolower($randomStr).'.'.$ext;
        $file->move('upload/profile/', $filename);

        $parent -> profile_picture = $filename;
    } 
        $parent-> name = trim($request->name);
        $parent-> last_name = trim($request->last_name);
        $parent-> gender = trim($request->gender);
        $parent-> occupation = trim($request->occupation);
        $parent-> address = trim($request->address);
        $parent-> mobile_number = trim($request->mobile_number);
        $parent-> email = trim($request->email);
        $parent-> save();

    return redirect()->back()->with('success','Profile Successfully Updated');
}

public function UpdateAccountTeacher(Request $request){
    $id = Auth::user()->id;
    request()->validate([
        'email' => 'required|email|unique:users,email,'.$id,
        'mobile_number' => 'max:15|min:10',

    ]);
    
    $teacher = User::getSingle($id);
    if(!empty($request->file('profile_picture')))
    {
        $ext = $request->file('profile_picture')->getClientOriginalExtension();
        $file = $request->file('profile_picture');
        $randomStr = str()->random(20);
        $filename = strtolower($randomStr).'.'.$ext;
        $file->move('upload/profile/', $filename);

        $teacher -> profile_picture = $filename;
    } 
        $teacher-> name = trim($request->name);
        $teacher-> last_name = trim($request->last_name);
        $teacher-> gender = trim($request->gender);
        $teacher-> date_of_birth = trim($request->date_of_birth);
        $teacher-> marital_status = trim($request->marital_status);
        $teacher-> work_experience = trim($request->work_experience);
        $teacher-> date_of_joining = trim($request->date_of_joining);
        $teacher-> address = trim($request->address);
        $teacher-> permanent_address = trim($request->permanent_address);
        $teacher-> qualification = trim($request->qualification);
        $teacher-> mobile_number = trim($request-> mobile_number);
        $teacher-> email = trim($request->email);
        $teacher-> save();

    return redirect()->back()->with('success','Profile Successfully Updated');
}
}


