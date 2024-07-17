@extends('layouts.app')

@section('content')
<br />
<div class="container-fluid">
    <div class="content-wrapper">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Parent Data</h3>
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
                <div class="form-group col-md-4">
                  <label for="name">Gender<span style="color: red">*</span></label>
                <select class="form-control" required name="gender">
                  <option value="">Select Gender</option>
                  <option {{(old('gender',$getRecord->gender)=='Male')? 'selected':''}} value="Male">Male</option>
                  <option {{(old('gender',$getRecord->gender)=='Female')? 'selected':''}} value="Female">Female</option>
                  <option {{(old('gender',$getRecord->gender)=='Other')? 'selected':''}} value="Other">Other</option>
                </select>
                <div style="color: red">{{$errors->first('gender')}}</div>
                </div>
              </div>
              <h4>Other Data:</h4>
              <hr>
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="name">Occupation<span style="color: red">*</span></label>
                  <input type="text" class="form-control" value="{{ old('occupation',$getRecord->occupation)}}" name="occupation" required placeholder="Occupation">
                  <div style="color: red">{{$errors->first('occupation')}}</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="address">Address<span style="color: red">*</span></label>
                  <input type="text" class="form-control" value="{{ old('address',$getRecord->address)}}" name="address" required placeholder="Address">
                  <div style="color: red">{{$errors->first('address')}}</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Status<span style="color: red">*</span></label>
                <select class="form-control" required name="status">
                  <option value="">Select Status</option>
                  <option {{(old('status',$getRecord->status)==0 )? 'selected':''}} value="0">Active</option>
                  <option  {{(old('status',$getRecord->status)== 1 )? 'selected':''}} value="1">Inactive</option>
                </select>
                <div style="color: red">{{$errors->first('status')}}</div>
                </div>

              </div><h4>Contact:</h4>
              <hr>
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="name">Mobile Number</span></label>
                  <input type="text" class="form-control" value="{{ old('mobile_number',$getRecord->mobile_number)}}" name="mobile_number" placeholder="Mobile Number">
                  <div style="color: red">{{$errors->first('mobile_number')}}</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="email">Email<span style="color: red">*</span></label>
                  <input type="email" class="form-control" name="email" value="{{ old('email',$getRecord->email)}}"  required placeholder="Enter email">
                  <div style="color: red">{{$errors->first('email')}}</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="password">Password<span style="color: red">*</span></label>
                  <input type="password" class="form-control" name="password"  placeholder="Password">
                  <div style="color: red">{{$errors->first('password')}}</div>
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