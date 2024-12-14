@extends('layouts.site')

@push('styles')
@endpush
@section('content')
<main class="main">

    <!-- Hero Section -->
   <section id="hero" class="hero section dark-background" style="position: relative;">
  <div class="container" style="position: relative; z-index: 2;">
    <div class="row gy-4">
      <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
        <h1 style="font-size: 3rem; font-weight: bold; color: #fff; text-transform: uppercase; text-shadow: 2px 2px 8px rgba(0,0,0,0.5); line-height: 1.2;">
          XPRO AWARD 2024
        </h1>
        <!-- Subheading with a softer, modern feel -->

        <p style="font-size: 1.2rem; color: #f4f4f4; font-style: italic; margin-top: 10px;">
          Join us in celebrating the outstanding achievements of our XPRO members in 2024. Your vote can help recognize the hard work, dedication, and passion of those who make XPRO truly exceptional. <br/>Don’t miss out on supporting your favorite nominees!
        </p>

        <div class="d-flex">
          <a href="#categories" class="btn-get-started">Vote Now!</a>
        </div>
      </div>
      <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200" style="z-index: 3; position: relative;">
        <img src="assets/img/logo.png" class="img-fluid animated" alt="XPRO Award 2024" style="max-height: 400px;">
      </div>
    </div>
  </div>
  <div style="background: url('assets/img/paralax2.png'); background-size: cover; position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></div>
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

        <div class="row gy-4">
            @foreach($categories as $category)
            <div class="col-xl-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                <div class="service-item d-flex align-items-center">
                    <div class="icon me-3"><i class="bi bi-award icon"></i></div>
                    <h4><a href="{{ route('category.show', $category->id) }}" class="stretched-link">{{ $category->name
                            }}</a></h4>
                </div>
            </div><!-- End Service Item -->
            @endforeach
        </div><!-- End Row -->


      </div>

    </section><!-- /Services Section -->

  </main>
@endsection

@push('scripts')
@endpush
