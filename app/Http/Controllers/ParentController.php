<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function list(){
        $getRecord =User::getParent();
        return view('admin.parent.list', ['getRecord' => $getRecord,]);
    }

    public function add(){
        $getRecord =User::getParent();
        return view('admin.parent.add', ['getRecord' => $getRecord]);
    }

    public function insert(Request $request){

        request()->validate([
            'email' => 'required|email|unique:users',
            'mobile_number' => 'max:15|min:10',
            'address' => 'max:255',
            'occupation' => 'max:255',

        ]);
        
        $parent = new User;
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
        $parent -> role = 'parent';
        $parent-> last_name = trim($request->last_name);
        $parent-> gender = trim($request->gender);
        if(!empty($request->occupation))
        {
            $parent-> occupation = trim($request->occupation);
        }
        if(!empty($request->address))
        {
            $parent-> address = trim($request->address);
        }
        $parent-> status = trim($request->status);
        if(!empty($request->mobile_number))
        {
            $parent-> mobile_number = trim($request->mobile_number);
        }
        $parent-> email = trim($request->email);
        $parent-> password = hash::make($request->password);
        $parent-> save();

        return redirect('admin/parent/list')->with('success','Parent Successfully Added');
    }

    public function edit($id){
        $getRecord =User::getSingle($id);
        if(!empty($getRecord)){
            return view('admin.parent.edit', ['getRecord' => $getRecord]);
        }
        else{
            abort(404);
        }
        
    }

    public function update($id, Request $request)
    {
        
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
            'mobile_number' => 'max:15|min:10',
            'address' => 'max:255',
            'occupation' => 'max:255',


        ]);
        
        $parent = User::getSingle($id);
        if(!empty($request->file('profile_picture')))
        {
            if(!empty($parent->getProfile())){
                unlink('upload/profile/'.$parent->profile_picture);
            }
            $ext = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = str()->random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);

            $parent -> profile_picture = $filename;


        }
        $parent-> name = trim($request->name);
        $parent -> role = 'parent';
        $parent-> last_name = trim($request->last_name);
        $parent-> gender = trim($request->gender);
        if(!empty($request->address))
        {
            $parent-> address = trim($request->address);
        }
        if(!empty($request->occupation))
        {
            $parent-> occupation = trim($request->occupation);
        }
        if(!empty($request->mobile_number))
        {
            $parent-> mobile_number = trim($request->mobile_number);
        }
        $parent-> email = trim($request->email);
        if(!empty($request->password))
        {
        $parent-> password = hash::make($request->password);
        }
        $parent-> save();

        return redirect('admin/parent/list')->with('success','Parent Successfully Updated');
    }

    public function delete($id){
        $getRecord = User::getSingle($id);
        if(!empty($getRecord)){
        $getRecord->is_deleted = 1;
        $getRecord->save();

        return redirect()->back()->with('success', "Parent Deleted Successfully");
        }
        else{
            abort(404);
        }
}

    public function myStudent($id){
        $getParent = User::getSingle($id);
        $parent_id = $id;
        $getSearchStudent =User::getSearchStudent(); 
        $getRecord =User::getMyStudent($parent_id);
        return view('admin.parent.my_student', ['getSearchStudent' => $getSearchStudent,'parent_id' => $parent_id,'getRecord' => $getRecord,'getParent' =>$getParent]);
    }

    public function AssignStudentParent($student_id,$parent_id){
        $student = User::getSingle($student_id);
        $student -> parent_id = $parent_id; 
        $student -> save();
        

        return redirect()->back()->with('success', "Student Successfully Assigned to Parent");
}

public function AssignStudentParentDelete($student_id){
    $student = User::getSingle($student_id);
    $student -> parent_id = null; 
    $student -> save();
    
    return redirect()->back()->with('success', "Student Successfully Unassigned from Parent");
}
}