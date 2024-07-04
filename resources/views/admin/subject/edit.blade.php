@extends('layouts.app')

@section('content')
<br />
<div class="container-fluid">
    <div class="content-wrapper">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Subject</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="">
                {{ csrf_field() }}
              <div class="card-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" value="{{ $getRecord->name }}" name="name" placeholder="Enter Name">
                </div> 
                <div class="form-group">
                  <label for="name">Type</label>  
                  <input type="text" class="form-control" value="{{ $getRecord->type }}" name="type" placeholder="Enter Type">
                </div>
                <div class="form-group">
                  <label for ="status">Status</label>
                  <select class="form-control" name="status">
                    <option {{($getRecord->status == 0) ? 'selected':''}} value="0">Active</option>
                    <option {{($getRecord->status == 1) ? 'selected':''}} value="1">Inactive</option>
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