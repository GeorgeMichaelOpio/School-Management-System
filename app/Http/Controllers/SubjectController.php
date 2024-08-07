<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassSubjectModel;

class SubjectController extends Controller
{
    //

    
    public function list(){
        $getRecord = SubjectModel::getRecord();
        return view('admin.subject.list', ['getRecord' => $getRecord]);
    } 

    public function add(){
        return view('admin.subject.add');
    }

    public function insert(Request $request){
        $save = new SubjectModel;
        $save->name = $request->name;
        $save->status = $request->status;
        $save->type = $request->type;
        $save->created_by = Auth::user()->id;
        $save->save();
        
        return redirect('admin/subject/list')->with('success','Subject Added Successfully');
    }

    public function edit($id){

        $data['getRecord'] = SubjectModel::getSingle($id);
        if(!empty($data['getRecord'])){
            return view('admin.subject.edit',['getRecord' => $data['getRecord']]);
        }
        else{
            abort(404);
        }
    }
    
    public function update(Request $request, $id){
        $save = SubjectModel::getSingle($id);
        $save->name = $request->name;
        $save->type = $request->type;
        $save->status = $request->status;
        $save->save();
        
        return redirect('admin/subject/list')->with('success','Subject Updated Successfully');
    }

    public function delete($id){
        $user = SubjectModel::getSingle($id);
        $user->is_deleted =1;
        $user->save();

        return redirect()->back()->with('success', "Subject Deleted Successfully");

}

public function MySubjects(){
    
    $getRecord = ClassSubjectModel::MySubjects(Auth::user()->class_id);
    return view('student.mysubjects', ['getRecord' => $getRecord]);
}

public function my_studentsubject($student_id){
    $user = User::getSingle($student_id);
    $data['getuser'] = $user;
    $data['getRecord'] = ClassSubjectModel::MySubjects($user->class_id);
    return view('parent.mystudentsubject',$data);
}

}
