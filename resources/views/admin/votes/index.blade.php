@extends('admin.layouts.app')

@push('styles')
@endpush

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Votes</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active">Votes</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Votes List</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#resetVoteModal">
                            <i class="fa fa-refresh"></i> Reset All Votes
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <!-- Filter by Category -->
                    <form method="GET" action="{{ route('admin.votes.index') }}" class="mb-3">
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
                            <th>Voter</th>
                            <th>Category</th>
                            <th>Nominee</th>
                            <th>Vote Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($votes->isNotEmpty())
                        @foreach($votes as $key => $vote)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $vote->email }}</td>
                            <td>{{ $vote->category->name }}</td>
                            <td>{{ $vote->nominee->name }}</td>
                            <td>{{ $vote->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4" class="text-center">No votes found.</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<!-- Confirmation Dialog -->
<div class="modal fade" id="resetVoteModal" tabindex="-1" aria-labelledby="resetVoteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="resetVoteModalLabel">Confirm Reset</h4>
              </div>
            <div class="modal-body">
                <p>Are you sure you want to reset all votes? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="reset-votes-form" action="{{ route('admin.votes.reset') }}" method="POST" style="display:inline-block; margin-left:5px;">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-danger">Yes, Reset Votes</button>
                </form>
            </div>
        </div>
    </div>
</div>
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

    });
</script>
@endpush
