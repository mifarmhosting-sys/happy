@extends('layouts.app')

@section('content')
<section class="inner-banner-benefits">
  <div class="banner-overlay">
    <div class="" style="flex: auto;">
      <h1>Awards Us</h1>
      <p>Home / Awards</p>
    </div>
  </div>
</section>	  

<section class="award-page">
  <div class="award-container">
    <!-- Header -->
    <div class="award-header">
      <h1>Our Achievements</h1>
      <p>Celebrating milestones, excellence, and unforgettable journeys across the globe.</p>
    </div>

    <!-- Awards Grid -->
    <div class="award-grid">
      @foreach($awards as $a)
        <div class="award-card">
          <i class="{{ $a->icon_class }}"></i>
          <h3>{{ $a->title }}</h3>
          <p>{{ $a->description }}</p>
        </div>
      @endforeach
    </div>

    <!-- Stats Section -->
    <div class="award-stats">
      @foreach($stats as $s)
        <div class="stat">
          <h2>{{ $s->value }}</h2>
          <p>{{ $s->label }}</p>
        </div>
      @endforeach
    </div>

    <!-- CTA -->
    <div class="award-cta">
      <h2>Be Part of Our Journey</h2>
      <p>Experience award-winning travel like never before.</p>
      <a href="{{ route('hotels') }}" class="award-btn">Explore Packages</a>
    </div>
  </div>
</section>
@endsection
