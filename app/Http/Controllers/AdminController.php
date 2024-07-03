<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function list(){
        $getRecord =User::getAdmin();
        return view('admin.admin.list', ['getRecord' => $getRecord]);
    }

    public function add(){

        
        return view('admin.admin.add');
    }

    public function insert(Request $request){

        request()->validate([
            'email' => 'required|email|unique:users'
        ]);

        $user = new User; 
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->role = 'admin';
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('admin/list')->with('success','Admin Successfully Added');
    }

    public function edit($id){
        $data['getRecord'] = User::getSingle($id);

        if(!empty($data['getRecord'])){   
            return view('admin.admin.edit',['getRecord' => $data['getRecord']]);
        }
        else{
                abort(404);
            }
}

public function update($id,Request $request ){

        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::getSingle($id); 
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->role = 'admin';

        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        else{

        }
        
       
        $user->save();

        return redirect('admin/list')->with('success','Admin Successfully Updated');
}

    public function delete($id){
        $user = User::getSingle($id);
        $user->is_deleted =1;
        $user->save();

        return redirect()->back()->with('success', "Admin Deleted Successfully");

}
}
