@extends('layouts.site')

@push('styles')
@endpush
@section('content')
<main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
        <div class="container">
            <nav class="breadcrumbs">
                <ol>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li class="current">{{ $category->name }}</li>
                </ol>
            </nav>
            <h1>{{ $category->name }}</h1>
            <p style="font-size: 1.2rem; font-style: italic; margin-top: 10px;">{{ $category->description }}</p>
        </div>
    </div><!-- End Page Title -->

    <!-- Service Details Section -->
    <section id="service-details" class="service-details section">

        <div class="container">

            <div class="row gy-4">
                <div class="col-lg-4 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="100">
                    <div class="services-list">
                        @foreach($categories as $cat)
                        <a href="{{ route('category.show', $cat->id) }}"
                           @if($category->id == $cat->id) class="active" @endif>
                            {{ $cat->name }}
                        </a>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-8 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="row">
                        <!-- Nominee 1 -->
                        @foreach($category->nominees as $nominee)
                        <div class="col-6 col-lg-4 mb-4">
                            <div class="card nominee-card">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <h5 class="card-title">{{ $nominee->name }}</h5>
                                    <div class="vote-info">
                                        <span class="vote-count">Votes: {{ $nominee->votes->count() }}</span>
                                    </div>
                                    @if(isVotingEnabled())
                                        <!-- Vote Button for Each Nominee -->
                                        <button type="button" class="btn btn-primary form-control mt-3" onclick="openVoteModal({{ $nominee->id }}, {{ $category->id }})">Vote</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>


            </div>

        </div>

    </section><!-- /Service Details Section -->

</main>

<!-- Voting Form (Single form for all nominees) -->
<form id="voteForm" action="" method="POST">
    @csrf
    <input type="hidden" name="nominee_id" id="nominee_id">
    <input type="hidden" name="category_id" id="category_id">
    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
</form>

<!-- Modal HTML -->
<div class="modal fade" id="voteModal" tabindex="-1" aria-labelledby="voteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="voteModalLabel">Confirm Your Vote</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Please confirm your vote by entering your email address.</p>
                <div class="mb-3">
                    <label for="modalEmailInput" class="form-label">Email address</label>
                    <input type="email" id="modalEmailInput" class="form-control" name="email" placeholder="Enter your email">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmVoteButton">Submit Vote</button>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>
    function openVoteModal(nomineeId, categoryId) {
        // Set hidden inputs in the form
        document.getElementById('nominee_id').value = nomineeId;
        document.getElementById('category_id').value = categoryId;

        // Show the modal
        const voteModal = new bootstrap.Modal(document.getElementById('voteModal'));
        voteModal.show();
    }

    document.getElementById('confirmVoteButton').addEventListener('click', function () {
        // Get the email value from the modal input
        const emailInput = document.getElementById('modalEmailInput');
        const email = emailInput.value.trim();

        // Validate the email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email) {
            alert('Email address is required to vote.');
            return;
        }
        if (!emailRegex.test(email)) {
            alert('Please enter a valid email address.');
            return;
        }

        // Update the hidden email input in the form
        document.getElementById('email').value = email;

        // Optionally, update the form action dynamically if needed
        document.getElementById('voteForm').action = '{{ route('vote', ['nominee' => '__nominee_id__', 'category' => '__category_id__']) }}'
            .replace('__nominee_id__', document.getElementById('nominee_id').value)
            .replace('__category_id__', document.getElementById('category_id').value);

        // Submit the form
        document.getElementById('voteForm').submit();
    });
</script>

@endpush
