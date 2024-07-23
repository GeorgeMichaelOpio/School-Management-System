<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\ClassModel;

use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function list(){
        $getRecord =User::getTeacher();
        return view('admin.teacher.list', ['getRecord' => $getRecord,]);
    }

    public function add(){
        $getClass = ClassModel::getClass();
        $getRecord =User::getTeacher();
        return view('admin.teacher.add', ['getRecord' => $getRecord, 'getClass' => $getClass]);
    }

    public function insert(Request $request){

        request()->validate([
            'email' => 'required|email|unique:users',
            'mobile_number' => 'max:15|min:10',
            'gender' => 'max:50',
        ]);
        
        $teacher = new User;
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
        $teacher -> role = 'teacher';
        $teacher-> last_name = trim($request->last_name);
        $teacher-> gender = trim($request->gender);
        $teacher-> date_of_birth = trim($request->date_of_birth);
        $teacher-> marital_status = trim($request->marital_status);
        $teacher-> work_experience = trim($request->work_experience);
        $teacher-> date_of_joining = trim($request->date_of_joining);
        $teacher-> address = trim($request->address);
        $teacher-> permanent_address = trim($request->permanent_address);
        $teacher-> qualification = trim($request->qualification);
        $teacher-> status = trim($request->status);
        $teacher-> note = trim($request->note);
        $teacher-> mobile_number = trim($request-> mobile_number);
        $teacher-> email = trim($request->email);
        $teacher-> password = hash::make($request->password);
        $teacher-> save();

        return redirect('admin/teacher/list')->with('success','Teacher Successfully Added');
    }

    public function edit($id){
        $getRecord =User::getSingle($id);
        if(!empty($getRecord)){
            $getClass = ClassModel::getClass();
        
            return view('admin.teacher.edit', ['getRecord' => $getRecord, 'getClass' => $getClass]);
        }
        else{
            abort(404);
        }
        
    }

    public function update($id, Request $request)
    {
        
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'height' => 'max:10',
            'blood_group' => 'max:10',
            'mobile_number' => 'max:15|min:10',
            'religion' => 'max:50',
            'gender' => 'max:50',
            'weight' => 'max:10',
            'admission_number' => 'max:50',
            'roll_number' => 'max:50',

        ]);
        
        $teacher = User::getSingle($id);
        if(!empty($request->file('profile_picture')))
        {
            if(!empty($teacher->getProfile())){
                unlink('upload/profile/'.$teacher->profile_picture);
            }
            $ext = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = str()->random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);

            $teacher -> profile_picture = $filename;


        }
        $teacher-> name = trim($request->name);
        $teacher -> role = 'teacher';
        $teacher-> last_name = trim($request->last_name);
        $teacher-> gender = trim($request->gender);
        $teacher-> date_of_birth = trim($request->date_of_birth);
        $teacher-> marital_status = trim($request->marital_status);
        $teacher-> work_experience = trim($request->work_experience);
        $teacher-> date_of_joining = trim($request->date_of_joining);
        $teacher-> address = trim($request->address);
        $teacher-> permanent_address = trim($request->permanent_address);
        $teacher-> qualification = trim($request->qualification);
        $teacher-> status = trim($request->status);
        $teacher-> note = trim($request->note);
        $teacher-> mobile_number = trim($request-> mobile_number);
        $teacher-> email = trim($request->email);
        if(!empty($request->password))
        {
        $teacher-> password = hash::make($request->password);
        }
        $teacher-> save();

        return redirect('admin/teacher/list')->with('success','Teacher Successfully Updated');
    }

    public function delete($id){
        $getRecord = User::getSingle($id);
        if(!empty($getRecord)){
        $getRecord->is_deleted =1;
        $getRecord->save();

        return redirect()->back()->with('success', "Teacher Deleted Successfully");
        }
        else{
            abort(404);
        }

}
}
