@extends('layouts.app')

@section('content')
<br />
<div class="container-fluid">
    <div class="content-wrapper">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add New Student</h3>
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
                  <label for="name">Profile Picture</span></label>
                  <input type="file" class="form-control"  name="profile_picture">
                  <div style="color: red">{{$errors->first('profile_picture')}}</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="name">First Name<span style="color: red">*</span></label>
                  <input type="text" class="form-control" value="{{ old('name')}}" name="name" required placeholder="First Name">
                  <div style="color: red">{{$errors->first('name')}}</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Last Name<span style="color: red">*</span></label>
                  <input type="text" class="form-control" value="{{ old('last_name')}}" name="last_name" required placeholder="Last Name">
                  <div style="color: red">{{$errors->first('last_name')}}</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Gender<span style="color: red">*</span></label>
                <select class="form-control" required name="gender">
                  <option value="">Select Gender</option>
                  <option {{(old('gender')=='Male')? 'selected':''}} value="Male">Male</option>
                  <option {{(old('gender')=='Female')? 'selected':''}} value="Female">Female</option>
                  <option {{(old('gender')=='Other')? 'selected':''}} value="Other">Other</option>
                </select>
                <div style="color: red">{{$errors->first('gender')}}</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Date Of Birth<span style="color: red">*</span></label>
                  <input type="date" class="form-control" value="{{ old('date_of_birth')}}" name="date_of_birth" required>
                  <div style="color: red">{{$errors->first('date_of_birth')}}</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Blood Group</label>
                  <input type="text" class="form-control" value="{{ old('blood_group')}}" name="blood_group"  placeholder="Blood Group">
                  <div style="color: red">{{$errors->first('blood_group')}}</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Height</label>
                  <input type="text" class="form-control" value="{{ old('height')}}" name="height"  placeholder="Height">
                  <div style="color: red">{{$errors->first('height')}}</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Weight</label>
                  <input type="text" class="form-control" value="{{ old('weight')}}" name="weight"  placeholder="Weight">
                  <div style="color: red">{{$errors->first('weight')}}</div>
                </div>
              </div>

              <h4>Other Data:</h4>
              <hr>
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="name">Admission Number<span style="color: red">*</span></label>
                  <input type="text" class="form-control" value="{{ old('admission_number')}}" name="admission_number" required placeholder="Admission Number">
                  <div style="color: red">{{$errors->first('admission_number')}}</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Admission Date<span style="color: red">*</span></label>
                  <input type="date" class="form-control" value="{{ old('admission_date')}}" name="admission_date" required placeholder="Admission Date">
                  <div style="color: red">{{$errors->first('admission_date')}}</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Roll Number</label>
                  <input type="text" class="form-control" value="{{ old('roll_number')}}" name="roll_number"placeholder="Roll Number">
                  <div style="color: red">{{$errors->first('roll_number')}}</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Class<span style="color: red">*</span></label>
                <select class="form-control" required name="class_id">
                  <option value="">Select Class</option>
                  @foreach($getClass as $value)
                  <option {{(old('class_id')==$value ->id) ? 'selected':''}} value="{{ $value ->id }}">{{ $value ->name }}</option>
                  @endforeach
                </select>
                <div style="color: red">{{$errors->first('class_id')}}</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Caste</span></label>
                  <input type="text" class="form-control" value="{{ old('caste')}}" name="caste" placeholder="Caste">
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Religion</span></label>
                  <input type="text" class="form-control" value="{{ old('religion')}}" name="religion" placeholder="Religion">
                  <div style="color: red">{{$errors->first('religion')}}</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="name">Status<span style="color: red">*</span></label>
                <select class="form-control" required name="status">
                  <option value="">Select Status</option>
                  <option {{(old('status')==0 )? 'selected':''}} value="0">Active</option>
                  <option  {{(old('status')== 1 )? 'selected':''}} value="1">Inactive</option>
                </select>
                <div style="color: red">{{$errors->first('status')}}</div>
                </div>

              </div><h4>Contact:</h4>
              <hr>
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="name">Mobile Number</span></label>
                  <input type="text" class="form-control" value="{{ old('mobile_number')}}" name="mobile_number" placeholder="Mobile Number">
                  <div style="color: red">{{$errors->first('mobile_number')}}</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="email">Email<span style="color: red">*</span></label>
                  <input type="email" class="form-control" name="email" value="{{ old('email')}}"  required placeholder="Enter email">
                  <div style="color: red">{{$errors->first('email')}}</div>
                </div>
                <div class="form-group col-md-4">
                  <label for="password">Password<span style="color: red">*</span></label>
                  <input type="password" class="form-control" name="password" required placeholder="Password">
                  <div style="color: red">{{$errors->first('password')}}</div>
                </div>
              </div>
                
                
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        
    </div>

@endsection