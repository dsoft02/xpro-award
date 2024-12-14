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
                        Welcome to the XPRO Award Winners page! Celebrate the remarkable individuals who have earned
                        recognition for their outstanding achievements in 2024.
                    </p>

                    <div class="d-flex">
                        <a href="#categories" class="btn-get-started">Explore the Winners</a>
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
        <div class="pyro">
            <div class="before"></div>
            <div class="after"></div>
        </div>
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>2024 WINNERS</h2>
            <p>Here are the winners of each category for the XPRO Awards 2024. Congratulations to all the nominees and
                winners!</p>
            <p>Check out the total vote counts and celebrate the outstanding achievements of your favorites!</p>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row gy-4">
                @foreach($categories as $category)
                <div class="col-xl-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item d-flex flex-column align-items-center">
                        <div class="icon me-3">
                            <!-- Trophy Icon with Golden Color -->
                            <i class="bi bi-trophy trophy-icon"></i>
                        </div>

                        <!-- Display the winner information -->
                        @php
                        $winner = $category->nominees->first();
                        @endphp

                        @if($winner)
                        <div class="winner-info text-center mt-3">
                            <h4 class="winner-name">{{ $winner->name }}</h4>
                            <h6 class="category-name">{{ $category->name }}</h6>
                            <p class="vote-count">Total Votes: {{ $winner->votes_count }}</p>
                        </div>
                        @else
                        <div class="no-winner mt-3 text-center">
                            <p>No winner yet.</p>
                        </div>
                        @endif
                    </div>
                </div><!-- End Service Item -->
                @endforeach
            </div><!-- End Row -->
        </div><!-- End Container -->


    </section><!-- /Services Section -->

</main>
@endsection

@push('scripts')
@endpush
