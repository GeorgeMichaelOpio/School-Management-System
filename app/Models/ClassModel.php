<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'class';

    static public function getRecord(){
        $return = ClassModel::select('class.*','users.name as created_by_name')
        ->join('users', 'users.id','class.created_by','class.created_at');

        if(!empty(Request::get('name'))){
            $return = $return->where('class.name','like','%'.Request::get('name').'%');
        }
        if(!empty(Request::get('date'))){
            $return = $return->whereDate('class.created_at','=',Request::get('date'));
        }

        $return = $return->where('class.is_deleted','=','0')
        ->orderby('class.id','desc')
        -> paginate(5);

        return $return;
    } 

    static public function getSingle($id){

        return ClassModel::find($id);
    }

    static public function getClass()
    {
        $return = ClassModel::select('class.*')
        ->join('users', 'users.id','class.created_by')
        ->where('class.is_deleted','=','0')
        ->where('class.status','=','0')
        ->orderby('class.name','asc')
        -> get();

        return $return;
    }
}

