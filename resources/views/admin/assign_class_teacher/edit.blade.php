@extends('layouts.app')

@section('content')
<br />
<div class="container-fluid">
    <div class="content-wrapper">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Assign Class Teacher</h3>
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
                      <option {{($getRecord->class_id == $class->id) ? 'selected' : ''}} value="{{$class->id}}">{{$class->name}}</option>
                      @endforeach
                    </select>
                </div>


                <div class="form-group">
                  <label for="name">Teacher Name</label>
                  @foreach($getTeacher as $teacher)
                      @php
                        $checked = "";
                      @endphp
                    @foreach($getAssignedTeacherID as $teacherAssign)
                      @if($teacherAssign->teacher_id == $teacher->id)
                        @php
                          $checked = "checked";
                        @endphp
                      @endif
                      
                    @endforeach
                  <div>
                    <label style="font-weight: normal">
                      <input {{$checked}} type="checkbox" value="{{$teacher->id}}" name="teacher_id[]"> {{$teacher->name}}
                    </label>
                  </div>
                  @endforeach
                </div>

                <div class="form-group">
                  <label for ="status">Status</label>
                  <select class="form-control" name="status" required>
                    <option {{($getRecord->status == 0) ? 'selected' : ''}} value="0">Active</option>
                    <option {{($getRecord->status == 1) ? 'selected' : ''}} value="1">Inactive</option>
                  </select>
                </div>
                
                
                
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
    </div>

@endsection