@extends('layouts.app')

@section('content')
<br />
<div class="container-fluid">
    <div class="content-wrapper">
      @include('_message')
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">My Account</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="card-body">
              <h4>Bio Data:</h4>
              <hr>
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="name">Profile Picture</label>
                  <br>
                  @if(!empty($getRecord->getProfile()))
                    <img src="{{ $getRecord->getProfile() }}" alt="Profile Picture" style="border-radius: 50%; width: 200px;height:200px"/>
                  @endif
                  <input type="file" class="form-control"  name="profile_picture">
                  <div style="color: red">{{$errors->first('profile_picture')}}</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="name">First Name<span style="color: red">*</span></label>
                  <input type="text" class="form-control" value="{{ old('name',$getRecord->name) }}" name="name" required placeholder="First Name">
                  <div style="color: red">{{$errors->first('name')}}</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Last Name<span style="color: red">*</span></label>
                  <input type="text" class="form-control" value="{{ old('last_name',$getRecord->last_name) }}" name="last_name" required placeholder="Last Name">
                  <div style="color: red">{{$errors->first('last_name')}}</div>
                </div>
              </div><h4>Contact:</h4>
              <hr>
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="name">Mobile Number<span style="color: red">*</span></label>
                  <input type="text" class="form-control" value="{{ old('mobile_number',$getRecord->mobile_number)}}" name="mobile_number" required placeholder="Mobile Number">
                  <div style="color: red">{{$errors->first('mobile_number')}}</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="email">Email<span style="color: red">*</span></label>
                  <input type="email" class="form-control" name="email" value="{{ old('email',$getRecord->email)}}"  required placeholder="Enter email">
                  <div style="color: red">{{$errors->first('email')}}</div>
                </div>
              </div>
                
                
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
        
    </div>

@endsection