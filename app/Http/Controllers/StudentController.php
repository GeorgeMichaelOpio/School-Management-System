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
        return view('admin.student.list', ['getRecord' => $getRecord]);
    }

    public function add(){
        $getClass = ClassModel::getClass();
        $getRecord =User::getStudent();
        return view('admin.student.add', ['getRecord' => $getRecord, 'getClass' => $getClass]);
    }

    public function insert(Request $request){
        //dd($request->all());
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
}
