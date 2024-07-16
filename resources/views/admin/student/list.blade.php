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
              <input type="text" class="form-control" name="name" value="{{Request::get('name')}}"  placeholder="Enter Name">
          </div>
          <div class="form-group col-md-3">
            <label for="email">Email address</label>
            <input type="text" class="form-control" name="email" value="{{Request::get('email')}}" placeholder="Enter email">
          </div>
          <div class="form-group col-md-3">
            <label for="date">Date</label>
            <input type="date" class="form-control" name="date" value="{{Request::get('date')}}" placeholder="Enter Date">
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Create Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                  @foreach($getRecord as $value)
                  <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->email }}</td>
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