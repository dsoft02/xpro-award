@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Profile
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active">Edit Profile</li>
    </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ $admin->profile_picture_url }}"
                         alt="User profile picture">

                    <h3 class="profile-username text-center">{{ ucwords($admin->name) }}</h3>

                    <p class="text-muted text-center">{{ strtolower($admin->role) }}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Name</b> <a class="pull-right">{{ ucwords($admin->name) }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> <a class="pull-right">{{ strtolower($admin->email) }}</a>
                        </li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#profile" data-toggle="tab">Profile Details</a></li>
                    <li><a href="#password" data-toggle="tab">Change Password</a></li>
                </ul>
                <div class="tab-content pad-box">
                    <div class="active tab-pane" id="profile">
                        <form id="profileForm" method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group @error('name') has-error @enderror">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Full Name" value="{{ old('name', $admin->name) }}">
                                @error('name')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('email') has-error @enderror">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="email@sample.com" value="{{ old('email',$admin->email) }}" readonly>
                                @error('email')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="password">
                        <form id="passwordForm" method="POST" action="{{ route('admin.profile.password') }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group @error('current_password') has-error @enderror">
                                <label for="update_password_current_password">Current Password</label>
                                <input type="password" class="form-control" id="update_password_current_password" name="current_password" autocomplete="current-password">
                                @error('current_password')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('password') has-error @enderror">
                                <label for="update_password_password">New Password</label>
                                <input type="password" class="form-control" id="update_password_password" name="password" autocomplete="new-password">
                                @error('password')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('password_confirmation') has-error @enderror">
                                <label for="update_password_password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control" id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password">
                                @error('password_confirmation')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection
