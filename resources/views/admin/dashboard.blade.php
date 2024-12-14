@extends('admin.layouts.app')

@push('styles')
@endpush
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control Panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active">Control Panel</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
<div class="row">
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $totalCategories }}</h3>

              <p>Total Category</p>
            </div>
            <div class="icon">
              <i class="ion ion-briefcase"></i>
            </div>
            <a href="{{ route('admin.categories.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $totalNominees }}</h3>

              <p>Total Nominees</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="{{ route('admin.nominees.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $totalVotes }}</h3>

              <p>Tota Votes</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="{{ route('admin.votes.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
    <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="box-header">
                            <h3 class="box-title"> <i class="fa fa-university"></i> Quick icon</h3>
                        </div>

                        <a href="{{ route('admin.categories.index') }}" class="btn btn-app">
                  	    <i class="fa fa-briefcase"></i> Categories                        </a>

                        <a href="{{ route('admin.nominees.index') }}" class="btn btn-app">
                  	    <i class="fa fa-users"></i> Nominees                        </a>

                        <a href="{{ route('admin.votes.index') }}" class="btn btn-app">
                  	    <i class="fa fa-signal"></i> Votes                        </a>

                        <a href="{{ route('admin.winners.index') }}" class="btn btn-app">
                  	    <i class="fa fa-trophy"></i> Winners                        </a>

                        <a href="{{ route('admin.settings.index') }}" class="btn btn-app">
                        <i class="fa fa-cog"></i> Settings
                        </a>

                        <a href="{{ route('applogout') }}" class="btn btn-app">
                  	    <i class="fa fa-sign-out"></i> Logout                        </a>

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
