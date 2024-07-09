<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function list(){
        $getRecord = ClassModel::getRecord();
        return view('admin.class.list', ['getRecord' => $getRecord]);
    } 

    public function add(){
        return view('admin.class.add');
    }

    public function insert(Request $request){
        $save = new ClassModel;
        $save->name = $request->name;
        $save->status = $request->status;
        $save->created_by = Auth::user()->id;
        $save->save();
        
        return redirect('admin/class/list')->with('success','Class Added Successfully');
    }

    public function edit($id){

        $data['getRecord'] = ClassModel::getSingle($id);
        if(!empty($data['getRecord'])){
            return view('admin.class.edit',['getRecord' => $data['getRecord']]);
        }
        else{
            abort(404);
        }
    }

    public function update(Request $request, $id){
        $save = ClassModel::getSingle($id);
        $save->name = $request->name;
        $save->status = $request->status;
        $save->save();
        
        return redirect('admin/class/list')->with('success','Class Updated Successfully');
    }

    public function delete($id){
        $user = ClassModel::getSingle($id);
        $user->is_deleted =1;
        $user->save();

        return redirect()->back()->with('success', "Class Deleted Successfully");
}
}
