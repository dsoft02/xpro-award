@extends('admin.layouts.app')

@push('styles')
@endpush
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Categories</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active">Categories</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12 col-md-8 title-bar">
        </div>

        <div class="col-xs-12 col-md-4 text-right" style="margin-bottom:5px;">
            <a class="btn btn-primary" href="{{ route('admin.categories.create') }}"><i class="fa fa-plus"></i> Add
                new</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Category List</h3>
                </div>
                <div class="box-body">
                   <table id="list-table" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th style="width: auto; white-space: nowrap;">Category Name</th>
            <th style="width: 65%;">Description</th>
            <th class="text-center no-sort">Action</th>
        </tr>
    </thead>
    <tbody>
        @if($categories->isNotEmpty())
            @foreach($categories as $key => $category)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $category->name }}</td>
                    <td class="text-wrap">{{ $category->description }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center align-items-center" style="gap: 5px;">
                            <a class="btn btn-sm btn-info" href="{{ route('admin.categories.edit', $category->id) }}" title="Edit">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                                        onclick="return confirm('Are you sure you want to delete this category?');">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4" class="text-center">No categories found.</td>
            </tr>
        @endif
    </tbody>
</table>


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
$(document).ready(function() {
    let table = $('#list-table').DataTable();
    table.destroy();

    $('#list-table').DataTable({
        columnDefs: [
            { targets: 'no-sort', orderable: false }
        ]
    });
});

</script>
@endpush
