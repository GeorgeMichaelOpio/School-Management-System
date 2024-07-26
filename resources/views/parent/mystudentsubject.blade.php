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
            <h3 class="card-title">Subjects: {{$getuser->name}} {{$getuser->last_name}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Type</th>
                </tr>
                </thead>
                <tbody>
                
                @foreach($getRecord as $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->subject_name }}</td>
                    <td>
                    @if($value->status == 0 )
                        Active
                    @else
                    Inactive
                    @endif
                    </td>
                    <td>{{ $value->subject_type }}</td>
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