<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="{{ $settings->footer_blurb }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', $settings->site_name . ' | Discover the Art of Resort Living')</title>
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <link rel="stylesheet" href="{{ asset('css/master.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  @yield('styles')
</head>
<body>

  <!-- Site header: top bar + main navigation (fixed overlay) -->
  <header class="site-header" id="siteHeader">
    <div class="top-bar">
      <div class="container top-bar__inner">
        <p class="top-bar__contact">
          <span class="top-bar__label">Happy Miles Club</span>
        </p>
        <div class="top-bar__actions">
          @if(auth('member')->check())
            <a href="{{ route('member.profile') }}" class="top-bar__link" style="margin-right: 12px;"><i class="fa fa-user" style="margin-right: 5px;"></i>My Profile</a>
            <form action="{{ route('member.logout') }}" method="POST" style="display: inline;">
              @csrf
              <button type="submit" class="top-bar__link" style="background: none; border: none; cursor: pointer; padding: 0;"><i class="fa fa-sign-out-alt" style="margin-right: 5px;"></i>Logout</button>
            </form>
          @else
            <a href="{{ route('member.login') }}" class="top-bar__link top-bar__link--member"><i class="fa fa-lock" style="margin-right: 5px;"></i>Member Login</a>
          @endif
        </div>
      </div>
    </div>

    <div class="main-nav">
      <div class="container main-nav__inner">
        <a href="{{ route('home') }}" class="main-nav__brand" aria-label="Premium Travel Club home">
          <img src="{{ asset($settings->logo_path ? 'storage/' . $settings->logo_path : 'images/Premium.png') }}" alt="{{ $settings->site_name }}" class="main-nav__logo" width="180" height="40">
        </a>

        <button type="button" class="main-nav__toggle" id="navToggle" aria-label="Open menu" aria-controls="primaryNav" aria-expanded="false">
          <span class="main-nav__toggle-bar"></span>
          <span class="main-nav__toggle-bar"></span>
          <span class="main-nav__toggle-bar"></span>
        </button>

        <nav class="main-nav__menu" id="primaryNav" aria-label="Primary">
          <ul class="main-nav__list">
            <li><a href="{{ route('home') }}" class="main-nav__link {{ Request::routeIs('home') ? 'main-nav__link--active' : '' }}">Home</a></li>
            <li><a href="{{ route('hotels') }}" class="main-nav__link {{ Request::routeIs('hotels') ? 'main-nav__link--active' : '' }}">Properties</a></li>
            <li><a href="{{ route('benefits') }}" class="main-nav__link {{ Request::routeIs('benefits') ? 'main-nav__link--active' : '' }}">Verticals</a></li>
            <li><a href="{{ route('destinations') }}" class="main-nav__link {{ Request::routeIs('destinations') ? 'main-nav__link--active' : '' }}">Destination</a></li>
            <li><a href="{{ route('awards') }}" class="main-nav__link {{ Request::routeIs('awards') ? 'main-nav__link--active' : '' }}">Awards</a></li>
            <li><a href="{{ route('blog.index') }}" class="main-nav__link {{ Request::routeIs('blog.*') ? 'main-nav__link--active' : '' }}">Blog</a></li>
            <li><a href="{{ route('contact') }}" class="main-nav__link {{ Request::routeIs('contact') ? 'main-nav__link--active' : '' }}">Connect Us</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </header>

  <main id="main-content">
    @yield('content')
  </main>

  <!-- Site footer -->
  <footer class="site-footer">
    <div class="container site-footer__grid">
      <div class="site-footer__brand">
        <img src="{{ asset($settings->footer_logo_path ? 'storage/' . $settings->footer_logo_path : 'images/Premium.png') }}" alt="" class="site-footer__logo" width="160" height="36">
        <p class="site-footer__blurb">{{ $settings->contact_address }}</p>
        <p class="site-footer__blurb" style="margin-top: 10px; font-size: 0.9em; opacity: 0.8;">{{ $settings->footer_blurb }}</p>
      </div>
      <nav class="site-footer__nav" aria-label="Footer">
        <h3 class="site-footer__heading">Explore</h3>
        <ul class="site-footer__list">
          <li><a href="{{ route('hotels') }}">Our Hotels</a></li>
          <li><a href="{{ route('destinations') }}">Destinations</a></li>
          <li><a href="{{ route('awards') }}">Awards</a></li>
          <li><a href="{{ route('contact') }}">Contact Us</a></li>
        </ul>
      </nav>
      <div class="site-footer__legal">
        <h3 class="site-footer__heading">Legal</h3>
        <ul class="site-footer__list">
          <li><a href="#">Privacy notice</a></li>
          <li><a href="#">Cookie policy</a></li>
          <li><a href="#">Terms & Conditions</a></li>
        </ul>
      </div>
    </div>
    <div class="site-footer__bottom">
      <div class="container site-footer__bottom-inner">
        <p class="site-footer__copy">&copy; <span id="year"></span> {{ $settings->site_name }}. All rights reserved.</p>
        <div class="site-footer__social">
          <a href="{{ $settings->facebook_url ?? '#' }}" class="site-footer__social-link" aria-label="Facebook">f</a>
          <a href="{{ $settings->instagram_url ?? '#' }}" class="site-footer__social-link" aria-label="Instagram">in</a>
          <a href="{{ $settings->youtube_url ?? '#' }}" class="site-footer__social-link" aria-label="YouTube">▶</a>
        </div>
      </div>
    </div>
  </footer>

  <script>
    (function () {
      'use strict';

      var header = document.getElementById('siteHeader');
      var navToggle = document.getElementById('navToggle');
      var primaryNav = document.getElementById('primaryNav');
      var yearEl = document.getElementById('year');

      if (yearEl) {
        yearEl.textContent = new Date().getFullYear();
      }

      function onScroll() {
        if (!header) return;
        if (window.scrollY > 24) {
          header.classList.add('site-header--scrolled');
        } else {
          header.classList.remove('site-header--scrolled');
        }
      }

      window.addEventListener('scroll', onScroll, { passive: true });
      onScroll();

      if (navToggle && primaryNav) {
        navToggle.addEventListener('click', function () {
          var open = primaryNav.classList.toggle('main-nav__menu--open');
          navToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
          navToggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
        });
      }

      /* Section reveal on scroll */
      var revealSections = document.querySelectorAll('.section--reveal');
      if ('IntersectionObserver' in window && revealSections.length) {
        var io = new IntersectionObserver(function (entries) {
          entries.forEach(function (entry) {
            if (entry.isIntersecting) {
              entry.target.classList.add('section--visible');
            }
          });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        revealSections.forEach(function (el) { io.observe(el); });
      } else {
        revealSections.forEach(function (el) { el.classList.add('section--visible'); });
      }
    })();
  </script>
  @yield('scripts')
</body>
</html>
