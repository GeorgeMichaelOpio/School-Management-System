@extends('layouts.app')

@section('content')
<br>

<!-- Content Wrapper. Contains page content -->
<div class="container-fluid">
  <div class="content-wrapper">
    @include('_message')
    
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Search Teacher</h3>
      </div>
      <form method="GET" action="">
        <div class="card-body row">
          <div class="form-group col-md-3">
              <label for="name">First Name</label>
              <input type="text" class="form-control" name="name" value="{{Request::get('name')}}"  placeholder="First Name">
          </div>
          <div class="form-group col-md-3">
            <label for="name">Last Name</label>
            <input type="text" class="form-control" name="last_name" value="{{Request::get('last_name')}}"  placeholder="Last Name">
        </div>
          <div class="form-group col-md-3">
            <label for="email">Email address</label>
            <input type="text" class="form-control" name="email" value="{{Request::get('email')}}" placeholder="Email">
          </div>
          <div class="form-group col-md-3">
            <label for="date">Date Of Joining</label>
            <input type="date" class="form-control" name="date_of_joining" value="{{Request::get('date_of_joining')}}" placeholder="Date Of Joining">
          </div>
          <div class="form-group col-md-3">
            <label for="class">Status</label>
            <input type="text" class="form-control" name="status" value="{{Request::get('status')}}" placeholder="Status">
          </div>
          <div class="form-group col-md-3">
            <label for="class">Work Experience</label>
            <input type="text" class="form-control" name="work_experience" value="{{Request::get('work_experience')}}" placeholder="Work Experience">
          </div>
          <div class="form-group col-md-3">
            <label for="qualification">Qualification</label>
            <input type="text" class="form-control" name="qualification" value="{{Request::get('qualification')}}" placeholder="qualification">
          </div>
        </div>
        <div class="form-group col-md-3">
          <button type="submit" class="btn btn-primary">Search</button>
          <a href="{{url('admin/teacher/list')}}" class="btn btn-success">Clear</a>
        </div>
      </form>
    </div>

    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Student List (Total: {{$getRecord ->total()}})</h3>

            <div class="card-tools">
              <a href="{{ url('admin/teacher/add') }}" class='btn btn-primary'>Add New Teacher</a>
            </div>

              
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Profile Picture</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Mobile Number</th>
                    <th>Date Of Birth</th>
                    <th>Date of Joining</th>
                    <th>Marital Status</th>
                    <th>Current Address</th>
                    <th>Permanent Address</th>
                    <th>Qualification</th>
                    <th>Work Experience</th>
                    <th>Note</th>
                    <th>Created Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                  @foreach($getRecord as $value)
                  <tr>
                    <td>{{ $value->id }}</td>
                    <td>
                        @if(!empty($value->getProfile()))
                          <img src="{{ $value->getProfile()}}" style="width: 50px;Height:50px;border-radius:50%">
                        @endif
                    </td>
                    <td>{{ $value->name }} {{ $value->last_name }}</td>
                    <td>{{ $value->gender}}</td>
                    <td>{{ $value->email }}</td>
                    <td>
                      @if($value->status == 0 )
                        Active
                      @else
                        Inactive
                      @endif
                    </td>
                    <td>{{ $value->mobile_number}}</td>
                    <td>{{ $value->date_of_birth}}</td>
                    <td>{{ $value->date_of_joining}}</td>
                    <td>{{ $value->marital_status}}</td>
                    <td>{{ $value->address }}</td>
                    <td>{{ $value->permanent_address }}</td>
                    <td>{{ $value->qualification }}</td>
                    <td>{{ $value->work_experience}}</td>
                    <td>{{ $value->note }}</td>
                    <td>{{ $value->created_at }}</td>
                    <td>
                      <a href="{{ url('admin/teacher/edit/'.$value->id) }}" class='btn btn-primary'>Edit</a>
                      <a href="{{ url('admin/teacher/delete/'.$value->id) }}" class='btn btn-danger'>Delete</a>
                    </td>
                  </tr>
                  @endforeach
                
                  <!-- End of foreach -->
                </tbody>
              </table>
              <div style="padding: 10px; float:right">
                {{ $getRecord->appends(request()->except('page'))->links() }}
              </div>
              


            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
  </div>
</div>

@endsection