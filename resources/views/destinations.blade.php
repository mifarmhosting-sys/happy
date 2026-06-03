@extends('layouts.app')

@section('styles')
<style>
  .destinations-section {
    padding: 80px 0;
    background-color: #faf9f6; /* premium soft beige/off-white background */
  }
  
  .destinations-header {
    text-align: center;
    max-width: 700px;
    margin: 0 auto 60px;
  }
  
  .destinations-header h2 {
    font-size: 2.5rem;
    color: var(--color-navy);
    font-weight: 700;
    margin-bottom: 15px;
    position: relative;
    padding-bottom: 15px;
  }
  
  .destinations-header h2::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background-color: var(--color-blue);
  }
  
  .destinations-header p {
    font-size: 1.1rem;
    color: var(--color-text-muted);
    line-height: 1.6;
  }
  
  .destinations-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 40px;
  }
  
  .destination-card {
    background: var(--color-white);
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
    border: 1px solid rgba(0, 0, 0, 0.05);
    display: flex;
    flex-direction: column;
    transition: transform 0.4s ease, box-shadow 0.4s ease;
  }
  
  .destination-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(10, 58, 107, 0.12);
  }
  
  .destination-image-wrapper {
    position: relative;
    overflow: hidden;
    height: 320px;
  }
  
  .destination-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
  }
  
  .destination-card:hover .destination-image {
    transform: scale(1.06);
  }
  
  .destination-body {
    padding: 35px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
  }
  
  .destination-title {
    font-size: 1.6rem;
    color: var(--color-navy);
    font-weight: 700;
    margin: 0 0 15px 0;
  }
  
  .destination-description {
    font-size: 0.95rem;
    color: var(--color-text-muted);
    line-height: 1.7;
    margin-bottom: 30px;
    flex-grow: 1;
  }
  
  .destination-btn {
    background-color: var(--color-blue);
    color: var(--color-white) !important;
    padding: 12px 28px;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    border-radius: 4px;
    display: inline-block;
    width: fit-content;
    text-align: center;
    transition: all 0.3s ease;
    border: none;
    box-shadow: 0 4px 12px rgba(10, 58, 107, 0.15);
  }
  
  .destination-btn:hover {
    background-color: #082d54;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(10, 58, 107, 0.25);
  }
  
  .destination-btn:active {
    transform: translateY(0);
  }
  
  @media (max-width: 768px) {
    .destinations-grid {
      grid-template-columns: 1fr;
      gap: 30px;
    }
    .destination-image-wrapper {
      height: 240px;
    }
    .destination-body {
      padding: 25px;
    }
  }
</style>
@endsection

@section('content')
<section class="inner-banner-benefits">
  <div class="banner-overlay">
    <div style="flex: auto;">
      <h1>Our Destinations</h1>
      <p>Home / Destinations</p>
    </div>
  </div>
</section>

<section class="destinations-section">
  <div class="container">
    <div class="destinations-header">
      <h2>Explore Premium Locations</h2>
      <p>Discover a handpicked collection of breathtaking destinations designed to offer the ultimate blend of luxury, adventure, and tranquility.</p>
    </div>
    
    <div class="destinations-grid">
      @foreach($destinations as $dest)
        <div class="destination-card">
          <div class="destination-image-wrapper">
            <img class="destination-image" src="{{ (file_exists(public_path($dest->image_path)) && $dest->image_path) ? asset($dest->image_path) : asset('storage/' . $dest->image_path) }}" alt="{{ $dest->name }}">
          </div>
          <div class="destination-body">
            <h3 class="destination-title">{{ $dest->name }}</h3>
            <p class="destination-description">{{ $dest->description }}</p>
            <a href="{{ route('contact') }}" class="destination-btn">Quick contact</a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endsection
