@extends('layouts.app')

@section('content')
<br>

<!-- Content Wrapper. Contains page content -->
<div class="container-fluid">
  <div class="content-wrapper">
    @include('_message')
    
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Search Parent</h3>
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
            <label for="status">Status</label>
          <select class="form-control" name="status">
            <option {{(Request::get('status')=='' )? 'selected':''}} value="">Select Status</option>
            <option {{(Request::get('status')=='0' )? 'selected':''}}  value="0">Active</option>
            <option {{(Request::get('status')=='1' )? 'selected':''}}  value="1">Inactive</option>
          </select>
          </div>
        </div>
        <div class="form-group col-md-3">
          <button type="submit" class="btn btn-primary">Search</button>
          <a href="{{url('admin/parent/list')}}" class="btn btn-success">Clear</a>
        </div>
      </form>
    </div>

    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Parent List (Total: {{$getRecord ->total()}})</h3>

            <div class="card-tools">
              <a href="{{ url('admin/parent/add') }}" class='btn btn-primary'>Add New Parent</a>
            </div>

              
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Profile Picture</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Occupation</th>
                    <th>Address</th>
                    <th>Status</th>
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
                    <td>{{ $value->name }} </td>
                    <td>{{ $value->last_name }}</td>
                    <td>{{ $value->gender}}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->mobile_number }}</td>
                    <td>{{ $value->occupation }}</td>
                    <td>{{ $value->address }}</td>
                    <td>
                      @if($value->status == 0 )
                        Active
                      @else
                        Inactive
                      @endif
                    </td>
                    <td>{{ $value->created_at }}</td>
                    <td>
                      <a href="{{ url('admin/parent/edit/'.$value->id) }}" class='btn btn-primary'>Edit</a>
                      <a href="{{ url('admin/parent/delete/'.$value->id) }}" class='btn btn-danger'>Delete</a>
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