@extends('layouts.app')

@section('content')
<section class="inner-banner-benefits">
  <div class="banner-overlay">
    <div class="" style="flex: auto;">
      <h1>Contact Us</h1>
      <p>Home / Contact Us</p>
    </div>
  </div>
</section>	  

<section class="contact">
  <!-- HERO -->
  <div class="contact-hero">
    <div class="container">
      <h1>Contact Us</h1>
      <p>We’re here to help you plan your perfect experience</p>
    </div>
  </div>

  <!-- MAIN -->
  <div class="contact-main container">
    <!-- LEFT INFO -->
    <div class="contact-info">
      <h3>Get in Touch</h3>
      <p>Have questions about our resorts, memberships or bookings? Our team is ready to assist you.</p>

      <div class="info-item">
        <strong>📍 Address</strong>
        <p>{{ $settings->contact_address }}</p>
      </div>

      <div class="info-item">
        <strong>📞 Phone</strong>
        <p>{{ $settings->contact_phone }}</p>
      </div>

      <div class="info-item">
        <strong>✉️ Email</strong>
        <p>{{ $settings->contact_email }}</p>
      </div>

      <div class="info-item">
        <strong>⏰ Working Hours</strong>
        <p>{{ $settings->working_hours }}</p>
      </div>
    </div>

    <!-- RIGHT FORM -->
    <div class="contact-form">
      <h3>Send a Message</h3>

      @if(session('success'))
        <div style="background: rgba(14, 180, 100, 0.15); color: #0eb464; padding: 15px; border-radius: 6px; margin-bottom: 20px; border: 1px solid rgba(14, 180, 100, 0.3); font-weight: 500;">
          {{ session('success') }}
        </div>
      @endif

      <div id="ajax-success" style="display: none; background: rgba(14, 180, 100, 0.15); color: #0eb464; padding: 15px; border-radius: 6px; margin-bottom: 20px; border: 1px solid rgba(14, 180, 100, 0.3); font-weight: 500;">
      </div>

      <form id="contact-form-el" action="{{ route('contact.submit') }}" method="POST">
        @csrf
        <div class="form-row">
          <input type="text" name="name" placeholder="Full Name" required>
          <input type="email" name="email" placeholder="Email Address" required>
        </div>

        <div class="form-row">
          <input type="text" name="phone" placeholder="Phone Number">
          <input type="text" name="subject" placeholder="Subject">
        </div>

        <textarea name="message" placeholder="Your Message" rows="5" required></textarea>

        <button type="submit" id="submit-btn">Send Message →</button>
      </form>
    </div>
  </div>

  <!-- MAP -->
  <div class="contact-map">
    <iframe 
      src="https://maps.google.com/maps?q={{ urlencode($settings->contact_address ?? 'kolkata') }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
      frameborder="0"
      allowfullscreen>
    </iframe>
  </div>
</section>  
@endsection

@section('scripts')
<script>
  document.getElementById('contact-form-el').addEventListener('submit', function(e) {
    var form = this;
    // Check if fetch is supported, else submit standard form
    if (typeof fetch !== 'function') return;

    e.preventDefault();
    var btn = document.getElementById('submit-btn');
    var successDiv = document.getElementById('ajax-success');
    
    btn.disabled = true;
    btn.textContent = 'Sending...';

    var formData = new FormData(form);

    fetch(form.action, {
      method: 'POST',
      body: formData,
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      }
    })
    .then(function(response) {
      return response.json();
    })
    .then(function(data) {
      btn.disabled = false;
      btn.textContent = 'Send Message →';
      if (data.success) {
        successDiv.textContent = data.success;
        successDiv.style.display = 'block';
        form.reset();
        
        // Scroll to success message
        successDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
    })
    .catch(function(err) {
      btn.disabled = false;
      btn.textContent = 'Send Message →';
      form.submit(); // Fallback to normal post on network error
    });
  });
</script>
@endsection
