@extends('admin.layouts.app')

@push('styles')
@endpush
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Edit Voter</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active">Edit Voter</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Update Voter details</h3>

                    <div class="box-tools pull-right">
                        <a class="btn btn-primary" href="{{ route('admin.voters.index') }}"><i
                                class="fa fa-chevron-left"></i>
                            Back to
                            List</a>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form role="form" method="POST"
                                  action="{{ route('admin.voters.update', $voter->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" value="{{ old('username', $voter->username) }}" required
                                        >
                                    </div>
                                    <div class="form-group">
                                        <label for="team_name">Team Name</label>
                                        <input type="text" class="form-control" name="team_name" id="team_name" placeholder="Enter Team Name" value="{{ old('team_name', $voter->team_name) }}" required
                                        >
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a class="btn btn-default" href="{{ route('admin.voters.index') }}"
                                       title="Cancel">Cancel</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection

@push('scripts')
@endpush
