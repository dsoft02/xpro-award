@extends('admin.layouts.app')

@push('styles')
@endpush
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>System Settings</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active">System Settings</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Update System Settings</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form role="form" method="POST" action="{{ route('admin.settings.update') }}">
                                @csrf
                                @method('PUT')
                                <div class="box-body">
                                    <!-- Site Name -->
                                    <div class="form-group">
                                        <label for="site_name">Site Name</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="site_name"
                                            id="site_name"
                                            placeholder="Enter Site Name"
                                            value="{{ old('site_name', $settings->site_name ?? '') }}"
                                            required
                                        >
                                    </div>

                                    <!-- Enable Voting -->
                                    <div class="form-group">
                                        <label for="enable_voting">Enable Voting</label>
                                        <select name="enable_voting" id="enable_voting" class="form-control">
                                            <option value="1" {{ old(
                                            'enable_voting', $settings->enable_voting ?? '') == 1 ? 'selected' : ''
                                            }}>Yes</option>
                                            <option value="0" {{ old(
                                            'enable_voting', $settings->enable_voting ?? '') == 0 ? 'selected' : ''
                                            }}>No</option>
                                        </select>
                                    </div>

                                    <!-- Declare Winner -->
                                    <div class="form-group">
                                        <label for="declare_winner">Declare Winner</label>
                                        <select name="declare_winner" id="declare_winner" class="form-control">
                                            <option value="1" {{ old(
                                            'declare_winner', $settings->declare_winner ?? '') == 1 ? 'selected' : ''
                                            }}>Yes</option>
                                            <option value="0" {{ old(
                                            'declare_winner', $settings->declare_winner ?? '') == 0 ? 'selected' : ''
                                            }}>No</option>
                                        </select>
                                    </div>

                                    <!-- Voting Start Time -->
                                    <div class="form-group">
                                        <label for="voting_start_time">Voting Start Time</label>
                                        <input
                                            type="datetime-local"
                                            class="form-control"
                                            name="voting_start_time"
                                            id="voting_start_time"
                                            value="{{ old('voting_start_time', $settings->voting_start_time ?? '') }}"
                                            required
                                        >
                                    </div>

                                    <!-- Voting End Time -->
                                    <div class="form-group">
                                        <label for="voting_end_time">Voting End Time</label>
                                        <input
                                            type="datetime-local"
                                            class="form-control"
                                            name="voting_end_time"
                                            id="voting_end_time"
                                            value="{{ old('voting_end_time', $settings->voting_end_time ?? '') }}"
                                            required
                                        >
                                    </div>

                                    <!-- Whitelist Domains -->
                                    <div class="form-group">
                                        <label for="whitelist_domains">Whitelist Domains (comma-separated)</label>
                                        <textarea
                                            id="whitelist_domains"
                                            name="whitelist_domains"
                                            class="form-control"
                                            rows="3"
                                            placeholder="Enter domains, separated by commas">{{ old('whitelist_domains', $settings->whitelist_domains ?? '') }}</textarea>
                                    </div>

                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Update Settings</button>
                                    <a class="btn btn-default" href="{{ route('admin.dashboard') }}" title="Cancel">Cancel</a>
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
        // Custom JavaScript (if required)
    });
</script>
@endpush
