@extends('layouts.app')

@section('content')
<br />
<div class="container-fluid">
    <div class="content-wrapper">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add New Assign Class Teacher</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="">
                {{ csrf_field() }}
              <div class="card-body">

                <div class="form-group">
                    <label for="name">Class Name</label>
                    <select class="form-control" name="class_id" required>
                      <option value="">Select Class</option>
                      @foreach($getclass as $class)
                      <option value="{{$class->id}}">{{$class->name}}</option>
                      @endforeach
                    </select>
                </div>


                <div class="form-group">
                  <label for="name">Teacher's Name</label>
                  @foreach($getTeacher as $teacher)
                  <div>
                    <label style="font-weight: normal">
                      <input type="checkbox" value="{{$teacher->id}}" name="teacher_id[]"> {{$teacher->name}} {{$teacher->last_name}}
                    </label>
                  </div>
                  @endforeach
                </div>

                <div class="form-group">
                  <label for ="status">Status</label>
                  <select class="form-control" name="status" required>
                    <option value="">Select Status</option>
                    <option value="0">Active</option>
                    <option value="1">Inactive</option>
                  </select>
                </div>
                
                
                
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        
   
    </div>

@endsection