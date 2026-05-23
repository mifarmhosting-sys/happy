@extends('layouts.app')

@section('content')
<section class="inner-banner">
  <div class="banner-overlay">
    <div class="" style="flex: auto;">
      <h1>About Us</h1>
      <p>Home / About</p>
    </div>
  </div>
</section>	  

<section class="about-details">
  <div class="container2">
    <!-- LEFT SIDE -->
    <div class="about-left">
      <div class="about-card text-card">
        <h3>{{ $about->amenities_title }}</h3>
        <p>{{ $about->amenities_description }}</p>
      </div>

      <div class="about-card image-card">
        <img src="{{ (file_exists(public_path($about->amenities_image_path)) && $about->amenities_image_path) ? asset($about->amenities_image_path) : asset('storage/' . $about->amenities_image_path) }}" alt="{{ $about->amenities_title }}">
      </div>

      <div class="about-card image-card">
        <img src="{{ (file_exists(public_path($about->offers_image_path)) && $about->offers_image_path) ? asset($about->offers_image_path) : asset('storage/' . $about->offers_image_path) }}" alt="{{ $about->offers_title }}">
      </div>

      <div class="about-card text-card">
        <h3>{{ $about->offers_title }}</h3>
        <p>{{ $about->offers_description }}</p>
      </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="about-right">
      <span class="small-title">{{ $about->subtitle }}</span>
      <h2>{{ $about->title }}</h2>
      <p>{{ $about->description1 }}</p>
      <p>{{ $about->description2 }}</p>
      <p>{{ $about->description3 }}</p>
    </div>
  </div>
</section>

<!-- About testimonials slider -->
<section class="testimonials">
  <div class="overlay">
    <div class="container">
      <h6 class="sub-title">OUR MEMBERS</h6>
      <h2 class="main-title">Testimonials</h2>

      <div class="testimonial-slider">
        <div class="slides">
          @foreach($testimonials->chunk(3) as $chunk)
            <div class="slide">
              @foreach($chunk as $t)
                <div class="card">
                  <img src="{{ (file_exists(public_path($t->avatar_path)) && $t->avatar_path) ? asset($t->avatar_path) : asset('storage/' . $t->avatar_path) }}" alt="">
                  <p>{{ $t->quote }}</p>
                </div>
              @endforeach
            </div>
          @endforeach
        </div>

        <!-- DOTS -->
        <div class="dots"></div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('scripts')
<script>
  (function () {
    'use strict';
    
    var slides = document.querySelector(".slides");
    var slideCount = document.querySelectorAll(".slide").length;
    var dotsContainer = document.querySelector(".dots");

    if (!slides || !slideCount || !dotsContainer) return;

    var index = 0;

    /* CREATE DOTS */
    for (var i = 0; i < slideCount; i++) {
      (function(di) {
        var dot = document.createElement("span");
        dot.addEventListener("click", function() { goToSlide(di); });
        dotsContainer.appendChild(dot);
      })(i);
    }

    var dots = document.querySelectorAll(".dots span");
    if (dots.length) {
      dots[0].classList.add("active");
    }

    /* FUNCTION */
    function goToSlide(i) {
      index = i;
      slides.style.transform = "translateX(-" + (i * 100) + "%)";

      dots.forEach(function(dot) { dot.classList.remove("active"); });
      if (dots[i]) {
        dots[i].classList.add("active");
      }
    }

    /* AUTO SLIDE */
    setInterval(function() {
      if (slideCount > 1) {
        index = (index + 1) % slideCount;
        goToSlide(index);
      }
    }, 4000);
  })();
</script>
@endsection
