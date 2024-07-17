<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



use Illuminate\Http\Request;


class StudentController extends Controller
{
    public function list(){
        $getRecord =User::getStudent();
        return view('admin.student.list', ['getRecord' => $getRecord,]);
    }

    public function add(){
        $getClass = ClassModel::getClass();
        $getRecord =User::getStudent();
        return view('admin.student.add', ['getRecord' => $getRecord, 'getClass' => $getClass]);
    }

    public function insert(Request $request){

        request()->validate([
            'email' => 'required|email|unique:users',
            'height' => 'max:10',
            'blood_group' => 'max:10',
            'mobile_number' => 'max:15|min:10',
            'religion' => 'max:50',
            'gender' => 'max:50',
            'weight' => 'max:10',
            'admission_number' => 'max:50',
            'roll_number' => 'max:50',

        ]);
        
        $student = new User;
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
        $student -> role = 'student';
        $student-> last_name = trim($request->last_name);
        $student-> gender = trim($request->gender);
        $student-> date_of_birth = trim($request->date_of_birth);
        if(!empty($request->blood_group))
        {
            $student-> blood_group = trim($request->blood_group);
        }
        if(!empty($request->height))
        {
            $student-> height = trim($request->height);
        }
        if(!empty($request->weight))
        {
            $student-> weight = trim($request->weight);
        }
        $student-> admission_number = trim($request->admission_number);
        $student-> admission_date = trim($request->admission_date);
        if(!empty($request->roll_number))
        {
            $student-> roll_number = trim($request->roll_number);
        }
        $student-> class_id = trim($request->class_id);
        if(!empty($request->caste))
        {
            $student-> caste = trim($request->caste);
        }
        if(!empty($request->caste))
        {
            $student-> religion = trim($request->religion);
        }
        $student-> status = trim($request->status);
        if(!empty($request->caste))
        {
            $student-> mobile_number = trim($request->mobile_number);
        }
        $student-> email = trim($request->email);
        $student-> password = hash::make($request->password);
        $student-> save();

        return redirect('admin/student/list')->with('success','Student Successfully Added');
    }

    public function edit($id){
        $getRecord =User::getSingle($id);
        if(!empty($getRecord)){
            $getClass = ClassModel::getClass();
        
            return view('admin.student.edit', ['getRecord' => $getRecord, 'getClass' => $getClass]);
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
        
        $student = User::getSingle($id);
        if(!empty($request->file('profile_picture')))
        {
            if(!empty($student->getProfile())){
                unlink('upload/profile/'.$student->profile_picture);
            }
            $ext = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = str()->random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);

            $student -> profile_picture = $filename;


        }
        $student-> name = trim($request->name);
        $student -> role = 'student';
        $student-> last_name = trim($request->last_name);
        $student-> gender = trim($request->gender);
        $student-> date_of_birth = trim($request->date_of_birth);
        if(!empty($request->blood_group))
        {
            $student-> blood_group = trim($request->blood_group);
        }
        if(!empty($request->height))
        {
            $student-> height = trim($request->height);
        }
        if(!empty($request->weight))
        {
            $student-> weight = trim($request->weight);
        }
        $student-> admission_number = trim($request->admission_number);
        $student-> admission_date = trim($request->admission_date);
        if(!empty($request->roll_number))
        {
            $student-> roll_number = trim($request->roll_number);
        }
        $student-> class_id = trim($request->class_id);
        if(!empty($request->caste))
        {
            $student-> caste = trim($request->caste);
        }
        if(!empty($request->caste))
        {
            $student-> religion = trim($request->religion);
        }
        $student-> status = trim($request->status);
        if(!empty($request->caste))
        {
            $student-> mobile_number = trim($request->mobile_number);
        }
        $student-> email = trim($request->email);
        if(!empty($request->password))
        {
        $student-> password = hash::make($request->password);
        }
        $student-> save();

        return redirect('admin/student/list')->with('success','Student Successfully Updated');
    }

    public function delete($id){
        $getRecord = User::getSingle($id);
        if(!empty($getRecord)){
        $getRecord->is_deleted =1;
        $getRecord->save();

        return redirect()->back()->with('success', "Student Deleted Successfully");
        }
        else{
            abort(404);
        }

}
    
}
 