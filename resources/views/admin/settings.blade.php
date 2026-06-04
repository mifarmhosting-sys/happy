@extends('admin.layout')

@section('title', 'Global Site Settings')

@section('content')
<div class="content-header">
  <div>
    <h1>Site Settings</h1>
    <p class="subtitle">Update global configuration details and contact information.</p>
  </div>
</div>

<div class="card">
  <div class="card-title">
    <span>Site Configuration</span>
  </div>

  <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-row">
      <div class="form-group">
        <label for="site_name">Site Brand Name</label>
        <input type="text" id="site_name" name="site_name" class="form-control" value="{{ old('site_name', $settings->site_name) }}" required>
        @error('site_name')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label>Current Logo (Fixed)</label>
        <div style="padding: 10px; background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 4px; display: inline-block;">
          <img class="img-preview" src="{{ asset('images/Premium.png') }}" alt="Logo" style="max-height: 40px; display: block;">
        </div>
        <p class="help-text" style="font-size: 0.8rem; color: #64748b; margin-top: 5px;">Logo is static and configured in the system files.</p>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="contact_phone">Contact Phone Number</label>
        <input type="text" id="contact_phone" name="contact_phone" class="form-control" value="{{ old('contact_phone', $settings->contact_phone) }}">
        @error('contact_phone')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label for="contact_email">Contact Email Address</label>
        <input type="email" id="contact_email" name="contact_email" class="form-control" value="{{ old('contact_email', $settings->contact_email) }}">
        @error('contact_email')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="working_hours">Working Hours</label>
        <input type="text" id="working_hours" name="working_hours" class="form-control" value="{{ old('working_hours', $settings->working_hours) }}" placeholder="e.g. Mon - Sat: 10:00 AM - 7:00 PM">
        @error('working_hours')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label for="contact_address">Physical Address</label>
        <input type="text" id="contact_address" name="contact_address" class="form-control" value="{{ old('contact_address', $settings->contact_address) }}">
        @error('contact_address')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
    </div>

    <div style="border-top: 1px solid var(--border); margin: 25px 0 20px; padding-top: 20px;">
      <h3 style="font-size: 1.05rem; margin-bottom: 15px;">Social Connections</h3>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="facebook_url">Facebook URL</label>
        <input type="url" id="facebook_url" name="facebook_url" class="form-control" value="{{ old('facebook_url', $settings->facebook_url) }}" placeholder="https://facebook.com/...">
        @error('facebook_url')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label for="instagram_url">Instagram URL</label>
        <input type="url" id="instagram_url" name="instagram_url" class="form-control" value="{{ old('instagram_url', $settings->instagram_url) }}" placeholder="https://instagram.com/...">
        @error('instagram_url')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="youtube_url">YouTube URL</label>
        <input type="url" id="youtube_url" name="youtube_url" class="form-control" value="{{ old('youtube_url', $settings->youtube_url) }}" placeholder="https://youtube.com/...">
        @error('youtube_url')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label for="footer_blurb">Footer Description Text</label>
        <textarea id="footer_blurb" name="footer_blurb" class="form-control" rows="3">{{ old('footer_blurb', $settings->footer_blurb) }}</textarea>
        @error('footer_blurb')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
    </div>

    <div style="margin-top: 20px; display: flex; justify-content: flex-end;">
      <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Save Settings
      </button>
    </div>
  </form>
</div>
@endsection
