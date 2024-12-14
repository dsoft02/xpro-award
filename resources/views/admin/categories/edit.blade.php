@extends('admin.layouts.app')

@push('styles')
@endpush
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Edit Category</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active">Edit Category</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Update Category details</h3>
                    <div class="box-tools pull-right">
                        <a class="btn btn-primary" href="{{ route('admin.categories.index') }}"><i
                                class="fa fa-chevron-left"></i>
                            Back to
                            List</a>
                    </div>
                </div>
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-6">
                            <form role="form" method="POST"
                                  action="{{ route('admin.categories.update', $category->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="name">Category Name</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="name"
                                            id="name"
                                            placeholder="Enter Category name"
                                            value="{{ old('name', $category->name) }}"
                                            required
                                        >
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea
                                            id="description"
                                            name="description"
                                            class="form-control"
                                            rows="5"
                                            placeholder="Enter Category description">{{ old('description', $category->description) }}</textarea>
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
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
@endpush
