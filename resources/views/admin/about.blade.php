@extends('admin.layout')

@section('title', 'Manage About Page')

@section('content')
<div class="content-header">
  <div>
    <h1>About Page Content</h1>
    <p class="subtitle">Modify descriptions, headers, and card images for the About Us page.</p>
  </div>
</div>

<form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
  @csrf

  <!-- MAIN ABOUT INTRO -->
  <div class="card">
    <div class="card-title">
      <span>About Us Intro Details</span>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="title">Title Header</label>
        <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $about->title) }}">
      </div>
      <div class="form-group">
        <label for="subtitle">Subtitle Eyebrow</label>
        <input type="text" id="subtitle" name="subtitle" class="form-control" value="{{ old('subtitle', $about->subtitle) }}">
      </div>
    </div>

    <div class="form-group">
      <label for="description1">Description Paragraph 1</label>
      <textarea id="description1" name="description1" class="form-control" rows="3">{{ old('description1', $about->description1) }}</textarea>
    </div>

    <div class="form-group">
      <label for="description2">Description Paragraph 2</label>
      <textarea id="description2" name="description2" class="form-control" rows="3">{{ old('description2', $about->description2) }}</textarea>
    </div>

    <div class="form-group">
      <label for="description3">Description Paragraph 3</label>
      <textarea id="description3" name="description3" class="form-control" rows="3">{{ old('description3', $about->description3) }}</textarea>
    </div>
  </div>

  <!-- PRIVILEGE AMENITIES CARD -->
  <div class="card">
    <div class="card-title">
      <span>Privilege Amenities Card</span>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="amenities_title">Amenities Card Title</label>
        <input type="text" id="amenities_title" name="amenities_title" class="form-control" value="{{ old('amenities_title', $about->amenities_title) }}">
      </div>
      <div class="form-group">
        <label for="amenities_image">Amenities Image</label>
        <input type="file" id="amenities_image" name="amenities_image" class="form-control">
        @if($about->amenities_image_path)
          <img class="img-preview" src="{{ (file_exists(public_path($about->amenities_image_path)) && $about->amenities_image_path) ? asset($about->amenities_image_path) : asset('storage/' . $about->amenities_image_path) }}" alt="Amenities Preview">
        @endif
      </div>
    </div>

    <div class="form-group">
      <label for="amenities_description">Amenities Card Text Description</label>
      <textarea id="amenities_description" name="amenities_description" class="form-control" rows="3">{{ old('amenities_description', $about->amenities_description) }}</textarea>
    </div>
  </div>

  <!-- SPECIAL OFFERS CARD -->
  <div class="card">
    <div class="card-title">
      <span>Special Offers Card</span>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="offers_title">Offers Card Title</label>
        <input type="text" id="offers_title" name="offers_title" class="form-control" value="{{ old('offers_title', $about->offers_title) }}">
      </div>
      <div class="form-group">
        <label for="offers_image">Offers Image</label>
        <input type="file" id="offers_image" name="offers_image" class="form-control">
        @if($about->offers_image_path)
          <img class="img-preview" src="{{ (file_exists(public_path($about->offers_image_path)) && $about->offers_image_path) ? asset($about->offers_image_path) : asset('storage/' . $about->offers_image_path) }}" alt="Offers Preview">
        @endif
      </div>
    </div>

    <div class="form-group">
      <label for="offers_description">Offers Card Text Description</label>
      <textarea id="offers_description" name="offers_description" class="form-control" rows="3">{{ old('offers_description', $about->offers_description) }}</textarea>
    </div>
  </div>

  <div style="margin-bottom: 40px; display: flex; justify-content: flex-end;">
    <button type="submit" class="btn btn-primary btn-lg" style="padding: 14px 28px;">
      <i class="fas fa-save"></i> Save About Page Content
    </button>
  </div>
</form>
@endsection
