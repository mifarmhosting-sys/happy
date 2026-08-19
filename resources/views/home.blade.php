@extends('layouts.app')

@section('content')
    <!-- Hero: full-viewport background video + overlay + CTA -->
    <section class="hero" aria-labelledby="hero-title">
      <div class="hero__media">
        @if(Str::endsWith($hero->video_path ?? '', '.mp4') || Str::endsWith($hero->video_path ?? '', '.webm'))
        <video
          class="hero__video"
          id="heroVideo"
          autoplay
          muted
          loop
          playsinline
          preload="auto"
          aria-hidden="true"
        >
          <source src="{{ (file_exists(public_path($hero->video_path)) && $hero->video_path) ? asset($hero->video_path) : asset('storage/' . $hero->video_path) }}" type="video/mp4">
        </video>
        @else
        <img class="hero__video" src="{{ (file_exists(public_path($hero->video_path)) && $hero->video_path) ? asset($hero->video_path) : asset('storage/' . $hero->video_path) }}" alt="" style="object-fit: cover; width: 100%; height: 100%;">
        @endif
      </div>
      <div class="hero__overlay"></div>

      <div class="hero__content container">
        <button type="button" class="hero__play hero__play--paused" id="heroPlay" aria-label="Pause background video">
          <span class="hero__play-icon" aria-hidden="true"></span>
        </button>
        <p class="hero__eyebrow">{{ $hero->eyebrow }}</p>
        <h1 class="hero__title" id="hero-title">{{ $hero->title }}</h1>
        <p class="hero__subtitle">{{ $hero->subtitle }}</p>
        <a href="#vacations" class="hero__scroll">
          <span class="hero__scroll-text">Scroll Down</span>
          <span class="hero__scroll-arrow" aria-hidden="true"></span>
        </a>
      </div>
    </section>

    <!-- Vacations: image grid + copy -->
    <section class="vacation section section--reveal" id="vacations">
      <div class="container vacation__grid">
        <div class="vacation__gallery">
          <figure class="vacation__figure">
            <img src="{{ (file_exists(public_path($welcome->image1_path)) && $welcome->image1_path) ? asset($welcome->image1_path) : asset('storage/' . $welcome->image1_path) }}" alt="Resort pool and palm trees" class="vacation__img" width="600" height="400" loading="lazy">
          </figure>
          <figure class="vacation__figure">
            <img src="{{ (file_exists(public_path($welcome->image2_path)) && $welcome->image2_path) ? asset($welcome->image2_path) : asset('storage/' . $welcome->image2_path) }}" alt="Beach lounge area" class="vacation__img" width="600" height="400" loading="lazy">
          </figure>
          <figure class="vacation__figure">
            <img src="{{ (file_exists(public_path($welcome->image3_path)) && $welcome->image3_path) ? asset($welcome->image3_path) : asset('storage/' . $welcome->image3_path) }}" alt="Ocean view from suite" class="vacation__img" width="600" height="400" loading="lazy">
          </figure>
          <figure class="vacation__figure">
            <img src="{{ (file_exists(public_path($welcome->image4_path)) && $welcome->image4_path) ? asset($welcome->image4_path) : asset('storage/' . $welcome->image4_path) }}" alt="Tropical gardens" class="vacation__img" width="600" height="400" loading="lazy">
          </figure>
        </div>

        <div class="vacation__copy">
          <p class="vacation__tag">{{ $welcome->tagline }}</p>
          <h2 class="vacation__title">{{ $welcome->title }}</h2>
          <p class="vacation__text">{{ $welcome->description1 }}</p>
          <p class="vacation__text">{{ $welcome->description2 }}</p>
          <p class="vacation__text vacation__text--accent">{{ $welcome->accent_text }}</p>
          <a href="{{ route('hotels') }}" class="btn btn--primary">Explore</a>
        </div>
      </div>
    </section>

    <!-- Hotel tabs: category tabs + animated hotel card grid -->
    <section class="hotel-tabs section section--reveal" aria-labelledby="hotel-tabs-heading">
      <div class="hotel-tabs__intro">
        <p class="hotel-tabs__tag">Our Hotels</p>
        <h2 class="hotel-tabs__title" id="hotel-tabs-heading">Filter Hotels</h2>
      </div>

      <div class="hotel-tabs__toolbar">
        <div class="hotel-tabs__bg"></div>
        <div class="hotel-tabs__overlay"></div>

        <div class="container hotel-tabs__toolbar-inner">
          <!-- Tabs: horizontal tab menu over scenic background -->
          <div class="hotel-tabs__bar-scroll">
            <div class="hotel-tabs__bar" role="tablist" aria-label="Hotel categories">
              @foreach($categories as $cat)
                @if(count($hotelTabData[$cat->slug] ?? []) > 0)
              <button
                type="button"
                class="hotel-tabs__tab {{ $loop->first ? 'hotel-tabs__tab--active' : '' }}"
                role="tab"
                id="hotel-tab-{{ $cat->slug }}"
                aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                aria-controls="hotelTabPanels"
                tabindex="{{ $loop->first ? 0 : -1 }}"
                data-hotel-tab="{{ $cat->slug }}"
              >
                <span class="hotel-tabs__icon" aria-hidden="true">
                  @if($cat->slug == 'all')
                    <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 21h18M5 21V10l7-4 7 4v11M9 21v-6h6v6"/></svg>
                  @elseif($cat->slug == 'adults')
                    <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="9" cy="7" r="3"/><path d="M3 21v-1a6 6 0 0 1 6-6h0a6 6 0 0 1 6 6v1"/><circle cx="17" cy="9" r="2.5"/><path d="M21 21v-1a4 4 0 0 0-3-3.87"/></svg>
                  @elseif($cat->slug == 'spa')
                    <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 3c2 3 6 6 6 10a6 6 0 1 1-12 0c0-4 4-7 6-10z"/><path d="M12 13v5"/></svg>
                  @elseif($cat->slug == 'wedding')
                    <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.5"><ellipse cx="9" cy="12" rx="4" ry="5"/><ellipse cx="15" cy="12" rx="4" ry="5"/></svg>
                  @else
                    <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                  @endif
                </span>
                <span class="hotel-tabs__label">{{ $cat->name }}</span>
              </button>
                @endif
              @endforeach
            </div>
          </div>

          <div class="hotel-tabs__destination">
            <button type="button" class="hotel-tabs__select" id="destinationBtn" aria-haspopup="listbox" aria-expanded="false">
              All Destination
              <span class="hotel-tabs__chevron" aria-hidden="true"></span>
            </button>
          </div>
        </div>
      </div>

      <!-- Card section: single tabpanel; inner grid swapped by script -->
      <div class="hotel-tabs__body">
        <div class="container">
          <div
            id="hotelTabPanels"
            class="hotel-tabs__panels"
            data-hotel-tabs-root
            role="tabpanel"
            aria-labelledby="hotel-tab-all"
          ></div>
        </div>
      </div>
    </section>

    <!-- Destinations: card grid -->
    <section class="destinations section section--reveal" id="destinations" aria-labelledby="destinations-title">
      <div class="container">
        <header class="destinations__header">
          <p class="destinations__eyebrow">Find Your Escape in Our</p>
          <h2 class="destinations__title" id="destinations-title">Destinations</h2>
        </header>

        <div class="destinations__grid">
          @foreach($destinations as $d)
          <article class="destination-card">
            <a href="#" class="destination-card__link">
              <div class="destination-card__media">
                <img src="{{ (file_exists(public_path($d->image_path)) && $d->image_path) ? asset($d->image_path) : asset('storage/' . $d->image_path) }}" alt="" class="destination-card__img" width="800" height="560" loading="lazy">
                <div class="destination-card__shade"></div>
              </div>
              <h3 class="destination-card__name">{{ $d->name }}</h3>
            </a>
          </article>
          @endforeach
        </div>
      </div>
    </section>

    <!-- Testimonials: basic slider (no external libraries) -->
    <section class="testimonials section section--reveal" aria-labelledby="testimonials-title">
      <div class="container testimonials__layout">
        <header class="testimonials__header">
          <p class="testimonials__eyebrow">Guest Moments</p>
          <h2 class="testimonials__title" id="testimonials-title">Stories From Our Members</h2>
        </header>

        <div class="testimonials__widget">
          <button type="button" class="testimonials__nav testimonials__nav--prev" id="testPrev" aria-label="Previous testimonial">
            <span aria-hidden="true">&#8249;</span>
          </button>

          <div class="testimonials__viewport">
            <div class="testimonials__track" id="testimonialTrack">
              @foreach($testimonials as $t)
              <article class="testimonials__slide">
                <blockquote class="testimonials__quote">
                  <p>{{ $t->quote }}</p>
                  <footer>
                    <cite class="testimonials__author">{{ $t->author }}</cite>
                    <span class="testimonials__role">{{ $t->role }}</span>
                  </footer>
                </blockquote>
                <div class="testimonials__avatar-wrap">
                  <img src="{{ (file_exists(public_path($t->avatar_path)) && $t->avatar_path) ? asset($t->avatar_path) : asset('storage/' . $t->avatar_path) }}" alt="" class="testimonials__avatar" width="96" height="96" loading="lazy">
                </div>
              </article>
              @endforeach
            </div>
          </div>

          <button type="button" class="testimonials__nav testimonials__nav--next" id="testNext" aria-label="Next testimonial">
            <span aria-hidden="true">&#8250;</span>
          </button>
        </div>

        <div class="testimonials__dots" id="testDots" role="tablist" aria-label="Testimonial slides"></div>
      </div>
    </section>
@endsection

@section('scripts')
  <script>
    // Dynamically inject PHP data for hotel tabs
    window.HOTEL_DATA = {!! json_encode($hotelTabData) !!};
  </script>
  <script src="{{ asset('js/hotel-tabs.js') }}?v={{ time() }}"></script>
  <script>
    (function () {
      'use strict';

      var heroPlay = document.getElementById('heroPlay');
      var heroVideo = document.getElementById('heroVideo');

      /* Testimonials slider */
      var track = document.getElementById('testimonialTrack');
      var btnPrev = document.getElementById('testPrev');
      var btnNext = document.getElementById('testNext');
      var dotsWrap = document.getElementById('testDots');
      var slides = track ? track.querySelectorAll('.testimonials__slide') : [];
      var index = 0;
      var slideCount = slides.length;

      if (track && slideCount > 0) {
        track.style.width = (slideCount * 100) + '%';
        slides.forEach(function(s) {
          s.style.width = (100 / slideCount) + '%';
          s.style.flex = '0 0 ' + (100 / slideCount) + '%';
        });
      }

      function setDotActive(i) {
        if (!dotsWrap) return;
        var dots = dotsWrap.querySelectorAll('.testimonials__dot');
        dots.forEach(function (d, j) {
          d.classList.toggle('testimonials__dot--active', j === i);
          d.setAttribute('aria-selected', j === i ? 'true' : 'false');
        });
      }

      function goTo(i) {
        if (!track || !slideCount) return;
        index = (i + slideCount) % slideCount;
        var pct = -(100 / slideCount) * index;
        track.style.transform = 'translateX(' + pct + '%)';
        setDotActive(index);
      }

      if (dotsWrap && slideCount) {
        for (var d = 0; d < slideCount; d++) {
          (function (di) {
            var b = document.createElement('button');
            b.type = 'button';
            b.className = 'testimonials__dot' + (di === 0 ? ' testimonials__dot--active' : '');
            b.setAttribute('role', 'tab');
            b.setAttribute('aria-selected', di === 0 ? 'true' : 'false');
            b.setAttribute('aria-label', 'Slide ' + (di + 1));
            b.addEventListener('click', function () { goTo(di); });
            dotsWrap.appendChild(b);
          })(d);
        }
      }

      if (btnPrev) btnPrev.addEventListener('click', function () { goTo(index - 1); });
      if (btnNext) btnNext.addEventListener('click', function () { goTo(index + 1); });

      /* Hero background video + play/pause control */
      function syncHeroPlayButton() {
        if (!heroPlay || !heroVideo) return;
        var paused = heroVideo.paused;
        heroPlay.classList.toggle('hero__play--paused', !paused);
        heroPlay.setAttribute('aria-label', paused ? 'Play background video' : 'Pause background video');
      }

      if (heroVideo && heroPlay) {
        if (heroVideo.nodeName === 'VIDEO') {
          heroVideo.addEventListener('play', syncHeroPlayButton);
          heroVideo.addEventListener('pause', syncHeroPlayButton);
          syncHeroPlayButton();

          heroPlay.addEventListener('click', function () {
            if (heroVideo.paused) {
              heroVideo.play().catch(function () {});
            } else {
              heroVideo.pause();
            }
          });

          document.addEventListener('visibilitychange', function () {
            if (!document.hidden && heroVideo.paused) {
              heroVideo.play().catch(function () {});
            }
          });
        } else {
          heroPlay.style.display = 'none'; // Hide play button if hero is static image
        }
      }
    })();
  </script>
@endsection
