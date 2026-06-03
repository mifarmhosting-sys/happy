@extends('layouts.app')

@section('content')
<section class="inner-banner-benefits">
  <div class="banner-overlay">
    <div class="" style="flex: auto;">
      <h1>Our benefits</h1>
      <p>Home / Benefits</p>
    </div>
  </div>
</section>	  

<section class="benefits">
  <!-- TOP EXPERIENCE -->
  <div class="benefits-top container">
    <div class="benefits-image">
      <img src="{{ asset('images/Benefits-Intro-2.jpg') }}" alt="Benefits Intro">
    </div>

    <div class="benefits-content">
      <p class="sub-title">MORE THAN</p>
      <h2>An Experience</h2>

      <p>
        <strong>The Happy Miles</strong> invites you to discover a world full of new experiences, luxury accommodations, and premium benefits designed to elevate every single vacation you take.
      </p>

      <p>
        We have everything from all-inclusive resorts in the Caribbean to scenic properties in the Canary Islands and Spain. Your luxury escape is just a few clicks away, backed by the highest service standards.
      </p>

      <p>
        With <strong>Dream Hospitality</strong>, you'll have direct access to reservations, special member-only rates, and local partner programs to ensure every step of your travel is smooth, memorable, and relaxing.
      </p>
    </div>
  </div>

  <!-- BENEFITS LIST -->
  <div class="benefits-bottom">
    <div class="container">
      <p class="sub-title center">OUR</p>
      <h2 class="main-title">Exclusive Benefits</h2>

      <div class="benefits-grid">
        @foreach($benefits as $b)
          <div class="benefit-item">
            <div class="icon-box">
              <img src="{{ (file_exists(public_path($b->icon_path)) && $b->icon_path) ? asset($b->icon_path) : asset('storage/' . $b->icon_path) }}" alt="{{ $b->title }}">
            </div>
            <div>
              <h4>{{ $b->title }}</h4>
              <p>{{ $b->description }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
@endsection
