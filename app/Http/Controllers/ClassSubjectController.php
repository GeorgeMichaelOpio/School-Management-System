<?php

namespace App\Http\Controllers;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\ClassSubjectModel;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class ClassSubjectController extends Controller
{
    //
    public function list(Request $request){
        $getRecord = ClassSubjectModel::getRecord();
        return view('admin.assign_subject.list', ['getRecord' => $getRecord]);
    }

    public function add(Request $request){

        $data['getclass'] = ClassModel::getClass();
        $data['getSubject'] = SubjectModel::getSubject();
        return view('admin.assign_subject.add', $data);
    }

    public function insert(Request $request){

        if(!empty($request->subject_id))
        {
            foreach($request->subject_id as $subject_id){

                $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $subject_id);

                if(!empty($getAlreadyFirst)){
                    $getAlreadyFirst->status =$request->status;
                    $getAlreadyFirst->save();
                }
                else{
                $save = new ClassSubjectModel;
                $save -> class_id = $request -> class_id;
                $save -> subject_id = $subject_id;
                $save -> status = $request -> status;
                $save -> created_by = Auth::user()->id;
                $save->save(); 
                }
   
            }

            return redirect('admin/assign_subject/list')->with('success','Subject Successfully Assigned to Class');
    }
    else{
            return redirect()->back()->with("error","Please Try Again");
        }
    }

    public function delete($id)
    {
        $save = ClassSubjectModel::getSingle($id);
        $save -> is_deleted = 1;
        $save -> save();

        return redirect('admin/assign_subject/list')->with('success','Record  Successfully Deleted');
    }

    public function edit($id){
        
        $getRecord = ClassSubjectModel::getSingle($id);

        if(!empty($getRecord)){
            $data['getRecord'] = $getRecord;
            $data['getAssignedSubjectID'] = ClassSubjectModel::getAssignedSubjectID($getRecord->class_id);
            $data['getclass'] = ClassModel::getClass();
            $data['getSubject'] = SubjectModel::getSubject();
            return view('admin.assign_subject.edit', $data);
        }
        else
        {
            abort(404);
        }

        
    }

    public function update(Request $request){
        ClassSubjectModel::deleteSubject($request->class_id);

        if(!empty($request->subject_id))
        {
            foreach($request->subject_id as $subject_id){

                $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $subject_id);

                if(!empty($getAlreadyFirst)){
                    $getAlreadyFirst->status =$request->status;
                    $getAlreadyFirst->save();
                }
                else{
                $save = new ClassSubjectModel;
                $save -> class_id = $request -> class_id;
                $save -> subject_id = $subject_id;
                $save -> status = $request -> status;
                $save -> created_by = Auth::user()->id;
                $save->save(); 
                }
   
            }
    }

        return redirect('admin/assign_subject/list')->with('success','Record Successfully Updated');
    
    }

    public function edit_single($id){
        $getRecord = ClassSubjectModel::getSingle($id);

        if(!empty($getRecord)){
            $data['getRecord'] = $getRecord;
            $data['getclass'] = ClassModel::getClass();
            $data['getSubject'] = SubjectModel::getSubject();
            return view('admin.assign_subject.edit_single', $data);
        }
        else
        {
            abort(404);
        }

    }

    public function update_single($id, Request $request){

                $getAlreadyFirst = ClassSubjectModel::getAlreadyFirst($request->class_id, $request->subject_id);

                if(!empty($getAlreadyFirst)){
                    $getAlreadyFirst->status =$request->status;
                    $getAlreadyFirst->save();

                    return redirect('admin/assign_subject/list')->with('success','Record Successfully Updated');
                }
                else
                {
                $save = ClassSubjectModel::getSingle($id);
                $save -> class_id = $request -> class_id;
                $save -> subject_id =$request->subject_id;
                $save -> status = $request -> status;
                $save->save();

                return redirect('admin/assign_subject/list')->with('success','Record Successfully Updated');
                }
        
    }
}
