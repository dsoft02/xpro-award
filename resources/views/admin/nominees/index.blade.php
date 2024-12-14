@extends('admin.layouts.app')

@push('styles')
@endpush
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Nominees</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active">Nominees</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12 col-md-8 title-bar">
        </div>

        <div class="col-xs-12 col-md-4 text-right" style="margin-bottom:5px;">
            <a class="btn btn-primary" href="{{ route('admin.nominees.create') }}"><i class="fa fa-plus"></i> Add
                new</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Nominees List</h3>
                </div>
                <div class="box-body">
                    <!-- Filter by Category -->
                    <form method="GET" action="{{ route('admin.nominees.index') }}" class="mb-3">
                        <div class="form-group">
                            <label for="category_id">Filter by Category</label>
                            <select class="form-control" id="category_id" name="category_id"
                                    onchange="this.form.submit()">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request(
                                'category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                    <table id="list-table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th style="width: auto; white-space: nowrap;">Nominee Name</th>
                            <th style="width: 65%;">Categories</th>
                            <th class="text-center no-sort">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($nominees->isNotEmpty())
                        @foreach($nominees as $key => $nominee)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $nominee->name }}</td>
                            <td class="text-wrap">
                                @php
                                $categories = $nominee->categories->pluck('name');
                                @endphp

                                @if($categories->count() > 3)
                                @foreach($categories->take(3) as $category)
                                <span>{{ $category }}</span><br>
                                @endforeach
                                <a href="javascript:void(0);" class="readmore" data-id="{{ $nominee->id }}">Read
                                    More</a>
                                <div id="more-categories-{{ $nominee->id }}" class="more-categories"
                                     style="display: none;">
                                    @foreach($categories->slice(3) as $category)
                                    <span>{{ $category }}</span><br>
                                    @endforeach
                                </div>
                                @else
                                @foreach($categories as $category)
                                <span>{{ $category }}</span><br>
                                @endforeach
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center align-items-center" style="gap: 5px;">
                                    <a class="btn btn-sm btn-info"
                                       href="{{ route('admin.nominees.edit', $nominee->id) }}" title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.nominees.destroy', $nominee->id) }}" method="POST"
                                          style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this nominee?');">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4" class="text-center">No nominees found.</td>
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
    $(document).ready(function () {
        let table = $('#list-table').DataTable();
        table.destroy();

        $('#list-table').DataTable({
            columnDefs: [
                {targets: 'no-sort', orderable: false}
            ]
        });

        $(document).on("click", ".readmore", function () {
            var nomineeId = $(this).data("id");
            var moreCategories = $("#more-categories-" + nomineeId);
            moreCategories.toggle();
            var newText = moreCategories.is(":visible") ? "Read Less" : "Read More";
            $(this).text(newText);
        });

    });

</script>
@endpush
