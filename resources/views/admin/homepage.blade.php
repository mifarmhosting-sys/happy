@extends('admin.layout')

@section('title', 'Manage Homepage')

@section('content')
<div class="content-header">
  <div>
    <h1>Homepage Content</h1>
    <p class="subtitle">Modify the Hero section, welcome details, and section media.</p>
  </div>
</div>

<form action="{{ route('admin.homepage.update') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <!-- HERO SECTION EDIT -->
  <div class="card">
    <div class="card-title">
      <span>Hero banner Segment</span>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="hero_eyebrow">Hero Eyebrow Text</label>
        <input type="text" id="hero_eyebrow" name="hero_eyebrow" class="form-control" value="{{ old('hero_eyebrow', $hero->eyebrow) }}">
      </div>
      <div class="form-group">
        <label for="hero_title">Hero Title Text</label>
        <input type="text" id="hero_title" name="hero_title" class="form-control" value="{{ old('hero_title', $hero->title) }}">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="hero_subtitle">Hero Subtitle Text</label>
        <input type="text" id="hero_subtitle" name="hero_subtitle" class="form-control" value="{{ old('hero_subtitle', $hero->subtitle) }}">
      </div>
      <div class="form-group">
        <label for="hero_video">Hero Background Video / Image (MP4 preferred)</label>
        <input type="file" id="hero_video" name="hero_video" class="form-control">
        @if($hero->video_path)
          <div style="margin-top: 10px; font-size: 0.85rem; color: var(--text-muted);">
            Current file: <code>{{ $hero->video_path }}</code>
          </div>
        @endif
      </div>
    </div>
  </div>

  <!-- WELCOME SECTION EDIT -->
  <div class="card">
    <div class="card-title">
      <span>Welcome Segment (Happy Miles Intro)</span>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="welcome_tagline">Welcome Segment Tagline</label>
        <input type="text" id="welcome_tagline" name="welcome_tagline" class="form-control" value="{{ old('welcome_tagline', $welcome->tagline) }}">
      </div>
      <div class="form-group">
        <label for="welcome_title">Welcome Segment Title</label>
        <input type="text" id="welcome_title" name="welcome_title" class="form-control" value="{{ old('welcome_title', $welcome->title) }}">
      </div>
    </div>

    <div class="form-group">
      <label for="welcome_description1">Description Paragraph 1</label>
      <textarea id="welcome_description1" name="welcome_description1" class="form-control" rows="4">{{ old('welcome_description1', $welcome->description1) }}</textarea>
    </div>

    <div class="form-group">
      <label for="welcome_description2">Description Paragraph 2</label>
      <textarea id="welcome_description2" name="welcome_description2" class="form-control" rows="4">{{ old('welcome_description2', $welcome->description2) }}</textarea>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="welcome_accent_text">Welcome Accent Text (Bottom Tagline)</label>
        <input type="text" id="welcome_accent_text" name="welcome_accent_text" class="form-control" value="{{ old('welcome_accent_text', $welcome->accent_text) }}">
      </div>
    </div>

    <div style="border-top: 1px solid var(--border); margin: 25px 0 20px; padding-top: 20px;">
      <h3 style="font-size: 1.05rem; margin-bottom: 15px;">Welcome Gallery Grid Images</h3>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="welcome_img1">Welcome Image 1</label>
        <input type="file" id="welcome_img1" name="welcome_img1" class="form-control">
        @if($welcome->image1_path)
          <img class="img-preview" src="{{ (file_exists(public_path($welcome->image1_path)) && $welcome->image1_path) ? asset($welcome->image1_path) : asset('storage/' . $welcome->image1_path) }}" alt="Preview 1">
        @endif
      </div>
      <div class="form-group">
        <label for="welcome_img2">Welcome Image 2</label>
        <input type="file" id="welcome_img2" name="welcome_img2" class="form-control">
        @if($welcome->image2_path)
          <img class="img-preview" src="{{ (file_exists(public_path($welcome->image2_path)) && $welcome->image2_path) ? asset($welcome->image2_path) : asset('storage/' . $welcome->image2_path) }}" alt="Preview 2">
        @endif
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="welcome_img3">Welcome Image 3</label>
        <input type="file" id="welcome_img3" name="welcome_img3" class="form-control">
        @if($welcome->image3_path)
          <img class="img-preview" src="{{ (file_exists(public_path($welcome->image3_path)) && $welcome->image3_path) ? asset($welcome->image3_path) : asset('storage/' . $welcome->image3_path) }}" alt="Preview 3">
        @endif
      </div>
      <div class="form-group">
        <label for="welcome_img4">Welcome Image 4</label>
        <input type="file" id="welcome_img4" name="welcome_img4" class="form-control">
        @if($welcome->image4_path)
          <img class="img-preview" src="{{ (file_exists(public_path($welcome->image4_path)) && $welcome->image4_path) ? asset($welcome->image4_path) : asset('storage/' . $welcome->image4_path) }}" alt="Preview 4">
        @endif
      </div>
    </div>
  </div>

  <div style="margin-bottom: 40px; display: flex; justify-content: flex-end;">
    <button type="submit" class="btn btn-primary btn-lg" style="padding: 14px 28px;">
      <i class="fas fa-save"></i> Save Homepage Content
    </button>
  </div>
</form>
@endsection
