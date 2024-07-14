@extends('layouts.app')

@section('content')
<br />
<div class="container-fluid">
    <div class="content-wrapper">
        @include('_message')
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Change Password</h3>
            </div>
            <form method="POST" action="">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Old Password</label>
                        <input type="password" class="form-control" value="" name="old_password" required placeholder="Enter Old Password">
                    </div>
                    <div class="form-group">
                        <label for="name">New Password</label>
                        <input type="password" class="form-control" value="" name="new_password" required placeholder="Enter New Password">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            </div>
        </div>
</div>

@endsection