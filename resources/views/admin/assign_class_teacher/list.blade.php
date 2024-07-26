@extends('layouts.app')

@section('content')
<br>

<!-- Content Wrapper. Contains page content -->
<div class="container-fluid">
  <div class="content-wrapper">
    @include('_message')
    
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Search Assign Class Teacher</h3>
      </div>
      <form method="GET" action="">
        <div class="card-body row">
          <div class="form-group col-md-3">
              <label for="name">Class Name</label>
              <input type="text" class="form-control" name="class_name" value="{{Request::get('class_name')}}"  placeholder="Enter Class Name">
          </div>

          <div class="form-group col-md-3">
            <label for="name">Teacher Name</label>
            <input type="text" class="form-control" name="teacher_name" value="{{Request::get('teacher_name')}}"  placeholder="Enter Teacher Name">
        </div>
          
          <div class="form-group col-md-3">
            <label for="date">Date</label>
            <input type="date" class="form-control" name="date" value="{{Request::get('date')}}" placeholder="Enter Date">
          </div>
        </div>
        <div class="form-group col-md-3">
          <button type="submit" class="btn btn-primary">Search</button>
          <a href="{{url('admin/assign_class_teacher/list')}}" class="btn btn-success">Clear</a>
        </div>
      </form>
    </div>

    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Assign Class Teacher List</h3>
 
            <div class="card-tools">
              <a href="{{ url('admin/assign_class_teacher/add') }}" class='btn btn-primary'>Add New Assign Class Teacher</a>
            </div> 

              
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Class Name</th>
                    <th>Teacher Name</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Created On</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                  @foreach($getRecord as $value)
                  <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->class_name }}</td>
                    <td>{{ $value->teacher_name }}</td>
                    <td>
                      @if($value->status == 0 )
                        Active
                      @else
                        Inactive
                      @endif
                    </td>
                    <td>{{ $value->created_by_name }}</td>
                    <td>{{ $value->created_at }}</td>
                    <td>
                      <a href="{{ url('admin/assign_class_teacher/edit/'.$value->id) }}" class='btn btn-primary'>Edit</a>
                      <a href="{{ url('admin/assign_class_teacher/edit_single/'.$value->id) }}" class='btn btn-primary'>Edit Single</a>
                      <a href="{{ url('admin/assign_class_teacher/delete/'.$value->id) }}" class='btn btn-danger'>Delete</a>
                      
                    </td>
                  </tr>
                  @endforeach
                
                  <!-- End of foreach -->
                </tbody>
              </table>

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