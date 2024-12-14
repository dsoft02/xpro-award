@extends('admin.layouts.app')

@push('styles')
@endpush
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Add Nominee</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active">Add Nominee</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12 col-md-8 title-bar">
        </div>

        <div class="col-xs-12 col-md-4 text-right" style="margin-bottom:5px;">
            <a class="btn btn-primary" href="{{ route('admin.nominees.index') }}"><i class="fa fa-chevron-left"></i>
                Back to
                List</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Enter nominee details</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form role="form" method="POST" action="{{ route('admin.nominees.store') }}">
                                @csrf
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="name">Nominee Name</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="name"
                                            id="name"
                                            placeholder="Enter Nominee name"
                                            value="{{ old('name') }}"
                                            required
                                        >
                                    </div>
                                    <div class="form-group">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select class="form-control SlectBox" id="category_id" name="category_ids[]"
                                                multiple="multiple" style="width:100%" required>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a class="btn btn-default" href="{{ route('admin.categories.index') }}"
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
<script>
    $(document).ready(function () {
        $('.SlectBox').SumoSelect({
            placeholder: 'Select Category',
            csvDispCount: 3,
            search: true,
            searchText: 'Search Category Here.'
        });
    });
</script>
@endpush
