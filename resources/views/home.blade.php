@extends('layouts.site')

@push('styles')
@endpush
@section('content')
<main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background" style="position: relative;">
        <div class="container" style="position: relative; z-index: 2;">
            <div class="row gy-4">
                <div
                    class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center text-center"
                    data-aos="zoom-out">
                    <h1 style="font-size: 3rem; font-weight: bold; color: #fff; text-transform: uppercase; text-shadow: 2px 2px 8px rgba(0,0,0,0.5); line-height: 1.2;">
                        XPRO AWARD 2024
                    </h1>
                    <!-- Subheading with a softer, modern feel -->
                    <p style="font-size: 1.2rem; color: #f4f4f4; font-style: italic; margin-top: 10px;">
                        Join us in celebrating the outstanding achievements of our XPRO members in 2024. Your vote can
                        help recognize the hard work, dedication, and passion of those who make XPRO truly exceptional.
                        <br/>Don’t miss out on supporting your favorite nominees!
                    </p>
                    <div class="d-flex">
                        <a href="#categories" class="btn-get-started">Vote Now!</a>
                    </div>
                </div>

                <div class="col-lg-6 order-1 order-lg-2 hero-img d-flex flex-column justify-content-center"
                     data-aos="zoom-out" data-aos-delay="200"
                     style="z-index: 3; position: relative;">
                    <img src="assets/img/logo.png" class="img-fluid animated" alt="XPRO Award 2024"
                         style="max-height: 400px;">
                </div>
            </div>
        </div>
        <div
            style="background: url('assets/img/paralax2.png'); background-size: cover; position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></div>
    </section><!-- /Hero Section -->


    <!-- Services Section -->
    <section id="categories" class="services section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>VOTING CATEGORIES</h2>
            <p>Choose a category and <b>CAST YOUR VOTE FOR YOUR FAVORITE NOMINEE!</b></p>
            <p>Note: You can vote once per category, but feel free to support your favorites!</p>
        </div><!-- End Section Title -->


        <div class="container">
            <form id="voteForm" action="{{ route('vote.store') }}" method="POST">
                @csrf
            <input type="hidden" name="username" id="username"/>
            <input type="hidden" name="team_name" id="team_name"/>
            <div class="row gy-4">
                @foreach($categories as $category)
                <div class="col-xl-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item d-flex flex-column align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="icon me-3"><i class="bi bi-award icon"></i></div>
                            <h4>
                                {{ $category->name }}
                            </h4>
                        </div>
                        @if(isVotingEnabled())
                        <select name="votes[{{ $category->id }}]" class="form-control select2 nomselbox" style="width: 100%;">
                            <option value="">-- Select a nominee --</option>
                            @foreach($category->nominees as $nominee)
                                <option value="{{ $nominee->id }}">{{ $nominee->name }}</option>
                            @endforeach
                        </select>
                        @endif
                    </div>
                </div><!-- End Service Item -->
                @endforeach
                @if(isVotingEnabled())
                <div class="col-md-6 offset-md-3 d-flex justify-content-center">
                    <button type="button" class="btn btn-primary form-control mt-4" onclick="openVoteModal()">
                        Submit Votes
                    </button>
                 </div>
                 @endif
            </div><!-- End Row -->
            </form>

        </div>

    </section><!-- /Services Section -->

</main>

@if(isVotingEnabled())
<!-- Modal HTML -->
<div class="modal fade" id="voteModal" tabindex="-1" aria-labelledby="voteModalLabel">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="voteModalLabel">Confirm Your Vote</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Please confirm your vote by entering your username and answer the question that follows.</p>
                <div class="mb-3">
                    <label for="modalUsernameInput" class="form-label"><b>Username</b></label>
                    <input type="text" id="modalUsernameInput" class="form-control" name="usernameInput"
                           placeholder="Enter your username">
                </div>
                <div class="mb-3">
                    <label for="modalTeamInput" class="form-label"><b>What team were you on during the last Super League tournament?</b></label>
                    <select class="form-control" id="modalTeamInput" name="teamInput">
                        <option value="">Select your team name</option>
                        <option>C-Sharp</option>
                        <option>Blaze FC</option>
                        <option>Champions FC</option>
                        <option>Gladiators</option>
                      </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmVoteButton">Submit Vote</button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
  $(function () {
    $('.select2').select2()
  })

  function openVoteModal() {
      // Show the modal
      const voteModal = new bootstrap.Modal(document.getElementById('voteModal'));
      voteModal.show();
  }

    document.getElementById('confirmVoteButton').addEventListener('click', function () {
        // Get the email value from the modal input
        const usernameInput = document.getElementById('modalUsernameInput');
        const teamInput = document.getElementById('modalTeamInput');
        const username = usernameInput.value;
        const teamname = teamInput.value;
        // Validate the username
        if (!username) {
            alert('Username is required to vote.');
            return;
        }

        if (!teamname) {
            alert('Team name is required to vote.');
            return;
        }

        document.getElementById('username').value = username;
        document.getElementById('team_name').value = teamname;

        const selectBoxes = document.querySelectorAll('select.nomselbox');
        const hasSelection = Array.from(selectBoxes).some(selectBox => selectBox.value !== '');
        // Display an alert if none have a selected value
        if (!hasSelection) {
            alert('Please select a nominee in at least one category.');
            return;
        }

        // Submit the form
        document.getElementById('voteForm').submit();
    });
</script>
@endpush
