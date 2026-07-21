@extends('layouts.app')

@section('styles')
<style>
  .benefits-bottom {
    background-color: #faf9f6 !important; /* Premium soft off-white/beige background */
    padding: 80px 0;
  }
  
  .main-title {
    font-size: 2.4rem;
    color: var(--color-navy);
    font-weight: 700;
    margin: 10px 0 50px;
    text-align: center;
  }

  .benefits-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
  }

  .benefit-card {
    background: var(--color-white);
    border-radius: 12px;
    padding: 30px;
    border: 1px solid rgba(0, 0, 0, 0.06);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.02);
    display: flex;
    gap: 25px;
    align-items: center;
    transition: transform 0.3s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
  }

  .benefit-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(12, 62, 114, 0.08);
  }

  .benefit-icon-wrapper {
    width: 75px;
    height: 75px;
    min-width: 75px;
    border: 2px solid #0c3e72; /* Premium navy border */
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffff;
    transition: background-color 0.3s ease, border-color 0.3s ease;
  }

  .benefit-card:hover .benefit-icon-wrapper {
    background-color: #0c3e72;
  }

  .benefit-icon-wrapper i {
    font-size: 28px;
    color: #0c3e72;
    transition: color 0.3s ease;
  }

  .benefit-card:hover .benefit-icon-wrapper i {
    color: #ffffff;
  }

  .benefit-icon-wrapper img {
    width: 32px;
    height: 32px;
    object-fit: contain;
  }

  .benefit-card-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .benefit-card-content h4 {
    font-size: 1.25rem;
    color: var(--color-navy);
    font-weight: 700;
    margin: 0 0 8px 0;
  }

  .benefit-card-content p {
    font-size: 0.95rem;
    color: var(--color-text-muted);
    line-height: 1.6;
    margin: 0;
  }

  @media (max-width: 768px) {
    .benefits-grid {
      grid-template-columns: 1fr;
      gap: 20px;
    }
    .benefit-card {
      flex-direction: column;
      align-items: flex-start;
      gap: 15px;
      padding: 25px;
    }
  }
</style>
@endsection

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
      <h2 class="main-title">Exclusive Benefits at Happy Miles Dream Hospitality</h2>

      <div class="benefits-grid">
        @foreach($benefits as $b)
          <div class="benefit-card">
            <div class="benefit-icon-wrapper">
              @if(Str::endsWith($b->icon_path, ['.svg', '.png', '.jpg', '.jpeg']))
                <img src="{{ (file_exists(public_path($b->icon_path)) && $b->icon_path) ? asset($b->icon_path) : asset('storage/' . $b->icon_path) }}" alt="{{ $b->title }}">
              @else
                <i class="{{ $b->icon_path }}"></i>
              @endif
            </div>
            <div class="benefit-card-content">
              <h4>{{ $loop->iteration }}. {{ $b->title }}</h4>
              <p>{{ $b->description }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
@endsection
