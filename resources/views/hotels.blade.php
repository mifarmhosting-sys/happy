@extends('layouts.app')

@section('content')
<section class="inner-banner-hotel">
  <div class="banner-overlay">
    <div class="" style="flex: auto;">
      <h1>Our Affiliated Hotels</h1>
      <p>Home / Our Hotels</p>
    </div>
  </div>
</section>	  

<section class="home-hotels-wrapper">
  <div class="container">
    <!-- TOP NAV -->
    <div class="hotel-nav">
      @foreach($hotelsByCountry as $country => $hotels)
        <a href="#{{ Str::slug($country) }}" class="{{ $loop->first ? 'active' : '' }}">{{ $country }}</a>
      @endforeach
    </div>
  </div>

  @foreach($hotelsByCountry as $country => $hotels)
    @if($country == 'Mexico')
      <!-- MEXICO SECTION -->
      <section class="mexico-section" id="{{ Str::slug($country) }}">
        <div class="container">
          <p class="sub-title">OUR HOTELS IN</p>
          <h2 class="main-title">{{ $country }}</h2>

          <div class="mexico-grid">
            @foreach($hotels as $h)
              <div class="mexico-col {{ $loop->iteration == 2 ? 'center' : '' }}">
                @if($loop->iteration == 2)
                  <!-- Image First -->
                  <div class="hotel-image">
                    <img src="{{ $h->image_url }}" alt="">
                  </div>
                  <!-- Content Card -->
                  <div class="hotel-card">
                    <div class="hotel-content">
                      <h3>{{ $h->name }}</h3>
                      <div class="rating">
                        @for($i = 1; $i <= 5; $i++)
                          {!! $i <= $h->rating ? '★' : '☆' !!}
                        @endfor
                        <span>{{ $h->location }}</span>
                      </div>
                      <p>{{ $h->description }}</p>
                      <a href="{{ $h->view_url }}" class="btn">VIEW HOTEL →</a>
                    </div>
                  </div>
                @else
                  <!-- Content Card First -->
                  <div class="hotel-card">
                    <div class="hotel-content">
                      <h3>{{ $h->name }}</h3>
                      <div class="rating">
                        @for($i = 1; $i <= 5; $i++)
                          {!! $i <= $h->rating ? '★' : '☆' !!}
                        @endfor
                        <span>{{ $h->location }}</span>
                      </div>
                      <p>{{ $h->description }}</p>
                      <a href="{{ $h->view_url }}" class="btn">VIEW HOTEL →</a>
                    </div>
                  </div>
                  <!-- Image -->
                  <div class="hotel-image">
                    <img src="{{ $h->image_url }}" alt="">
                  </div>
                @endif
              </div>
            @endforeach
          </div>
        </div>
      </section>

    @elseif($country == 'Spain')
      <!-- SPAIN SECTION -->
      <section class="spain-section" id="{{ Str::slug($country) }}">
        <div class="container">
          <p class="sub-title">OUR HOTELS IN</p>
          <h2 class="main-title">{{ $country }}</h2>

          <div class="spain-grid">
            @foreach($hotels as $h)
              <div class="spain-col">
                @if($loop->iteration == 2)
                  <!-- Center Column layout: Image First -->
                  <div class="hotel-image">
                    <img src="{{ $h->image_url }}" alt="">
                  </div>
                  <div class="hotel-card">
                    <div class="hotel-content">
                      <h3>{{ $h->name }}</h3>
                      <div class="rating">
                        @for($i = 1; $i <= 5; $i++)
                          {!! $i <= $h->rating ? '★' : '☆' !!}
                        @endfor
                        <span>{{ $h->location }}</span>
                      </div>
                      <p>{{ $h->description }}</p>
                      <a href="{{ $h->view_url }}" class="btn">VIEW HOTEL →</a>
                    </div>
                  </div>
                @else
                  <!-- Left/Right columns: Card First -->
                  <div class="hotel-card">
                    <div class="hotel-content">
                      <h3>{{ $h->name }}</h3>
                      <div class="rating">
                        @for($i = 1; $i <= 5; $i++)
                          {!! $i <= $h->rating ? '★' : '☆' !!}
                        @endfor
                        <span>{{ $h->location }}</span>
                      </div>
                      <p>{{ $h->description }}</p>
                      <a href="{{ $h->view_url }}" class="btn">VIEW HOTEL →</a>
                    </div>
                  </div>
                  <div class="hotel-image">
                    <img src="{{ $h->image_url }}" alt="">
                  </div>
                @endif
              </div>
            @endforeach
          </div>
        </div>
      </section>

    @else
      <!-- DEFAULT LISTING SECTION (Jamaica, etc.) -->
      <section class="home-hotels" id="{{ Str::slug($country) }}">
        <div class="container">
          <p class="sub-title">OUR HOTELS IN</p>
          <h2 class="main-title">{{ $country }}</h2>

          @foreach($hotels as $h)
            <div class="hotel-row {{ $loop->iteration % 2 == 0 ? 'reverse' : '' }}">
              @if($loop->iteration % 2 == 0)
                <div class="hotel-image">
                  <img src="{{ $h->image_url }}" alt="">
                </div>
                <div class="hotel-content">
                  <h3>{{ $h->name }}</h3>
                  <div class="rating">
                    @for($i = 1; $i <= 5; $i++)
                      {!! $i <= $h->rating ? '★' : '☆' !!}
                    @endfor
                    <span>{{ $h->location }}</span>
                  </div>
                  <p>{{ $h->description }}</p>
                  <a href="{{ $h->view_url }}" class="btn">VIEW HOTEL →</a>
                </div>
              @else
                <div class="hotel-content">
                  <h3>{{ $h->name }}</h3>
                  <div class="rating">
                    @for($i = 1; $i <= 5; $i++)
                      {!! $i <= $h->rating ? '★' : '☆' !!}
                    @endfor
                    <span>{{ $h->location }}</span>
                  </div>
                  <p>{{ $h->description }}</p>
                  <a href="{{ $h->view_url }}" class="btn">VIEW HOTEL →</a>
                </div>
                <div class="hotel-image">
                  <img src="{{ $h->image_url }}" alt="">
                </div>
              @endif
            </div>
          @endforeach
        </div>
      </section>
    @endif
  @endforeach
</section>
@endsection

@section('scripts')
<script>
  // Simple smooth scroll and tab switching style trigger for navigation
  document.querySelectorAll('.hotel-nav a').forEach(function(anchor) {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      document.querySelectorAll('.hotel-nav a').forEach(function(el) { el.classList.remove('active'); });
      this.classList.add('active');

      var targetId = this.getAttribute('href').substring(1);
      var targetEl = document.getElementById(targetId);
      if (targetEl) {
        window.scrollTo({
          top: targetEl.offsetTop - 120,
          behavior: 'smooth'
        });
      }
    });
  });
</script>
@endsection
