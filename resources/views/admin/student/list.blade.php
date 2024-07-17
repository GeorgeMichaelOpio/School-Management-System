@extends('layouts.app')

@section('content')
<br>

<!-- Content Wrapper. Contains page content -->
<div class="container-fluid">
  <div class="content-wrapper">
    @include('_message')
    
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Search Student</h3>
      </div>
      <form method="GET" action="">
        <div class="card-body row">
          <div class="form-group col-md-3">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" value="{{Request::get('name')}}"  placeholder="Name">
          </div>
          <div class="form-group col-md-3">
            <label for="email">Email address</label>
            <input type="text" class="form-control" name="email" value="{{Request::get('email')}}" placeholder="Email">
          </div>
          <div class="form-group col-md-3">
            <label for="date">Admission Date</label>
            <input type="date" class="form-control" name="admission_date" value="{{Request::get('admission_date')}}" placeholder="Admission Date">
          </div>
          <div class="form-group col-md-3">
            <label for="class">Class</label>
            <input type="class" class="form-control" name="class" value="{{Request::get('class')}}" placeholder="Class">
          </div>
        </div>
        <div class="form-group col-md-3">
          <button type="submit" class="btn btn-primary">Search</button>
          <a href="{{url('admin/student/list')}}" class="btn btn-success">Clear</a>
        </div>
      </form>
    </div>

    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Student List (Total: {{$getRecord ->total()}})</h3>

            <div class="card-tools">
              <a href="{{ url('admin/student/add') }}" class='btn btn-primary'>Add New Student</a>
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
                    <th>Admission Number</th>
                    <th>Admmision Date</th>
                    <th>Class</th>
                    <th>Roll Number</th>
                    <th>Religion</th>
                    <th>Create Date</th>
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
                    <td>{{ $value->admission_number}}</td>
                    <td>{{ $value->admission_date}}</td>
                    <td>{{ $value->class_name }}</td>
                    <td>{{ $value->roll_number }}</td>
                    <td>{{ $value->religion }}</td>
                    <td>{{ $value->created_at }}</td>
                    <td>
                      <a href="{{ url('admin/student/edit/'.$value->id) }}" class='btn btn-primary'>Edit</a>
                      <a href="{{ url('admin/student/delete/'.$value->id) }}" class='btn btn-danger'>Delete</a>
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