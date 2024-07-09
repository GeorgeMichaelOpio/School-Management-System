@extends('layouts.app')

@section('content')
<br />
<div class="container-fluid">
    <div class="content-wrapper">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add New Assign Subject</h3>
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
                  <label for="name">Subject Name</label>
                  @foreach($getSubject as $subject)
                  <div>
                    <label style="font-weight: normal">
                      <input type="checkbox" value="{{$subject->id}}" name="subject_id[]"> {{$subject->name}}
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