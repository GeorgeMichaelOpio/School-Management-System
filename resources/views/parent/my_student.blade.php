@extends('layouts.app')

@section('content')
<br>

<!-- Content Wrapper. Contains page content -->
<div class="container-fluid">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">My Student (Total: {{$getRecord ->total()}})</h3>
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
                        <th>Email</th>
                        <th>Class</th>
                        <th>Status</th>
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
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->class_name }}</td>
                        <td>
                            @if($value->status == 0 )
                            Active
                            @else
                            Inactive
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('/parent/mystudentsubject/'.$value->id) }}" class='btn btn-primary'>Subjects</a>
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