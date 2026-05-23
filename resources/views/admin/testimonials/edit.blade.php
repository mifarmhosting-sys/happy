@extends('admin.layout')

@section('title', 'Edit Testimonial')

@section('content')
<div class="content-header">
  <div>
    <h1>Edit Testimonial</h1>
    <p class="subtitle">Modify quote and author details.</p>
  </div>
  <div>
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
      <i class="fas fa-arrow-left"></i> Back to Testimonials
    </a>
  </div>
</div>

<div class="card" style="max-width: 600px;">
  <div class="card-title">
    <span>Testimonial Details</span>
  </div>

  <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label for="author">Author Name</label>
      <input type="text" id="author" name="author" class="form-control" value="{{ old('author', $testimonial->author) }}" required>
      @error('author')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
      <label for="role">Role / Detail (e.g. 'Member since 2022')</label>
      <input type="text" id="role" name="role" class="form-control" value="{{ old('role', $testimonial->role) }}">
      @error('role')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
      <label for="quote">Quote Content</label>
      <textarea id="quote" name="quote" class="form-control" rows="5" required>{{ old('quote', $testimonial->quote) }}</textarea>
      @error('quote')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
      <label for="type">Placement Type</label>
      <select id="type" name="type" class="form-control" required>
        <option value="home" {{ old('type', $testimonial->type) == 'home' ? 'selected' : '' }}>Home Page (Slide with details)</option>
        <option value="about" {{ old('type', $testimonial->type) == 'about' ? 'selected' : '' }}>About Page (Grid layout card)</option>
      </select>
      @error('type')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
      <label for="image">Replace Avatar / Review Image</label>
      <input type="file" id="image" name="image" class="form-control">
      @if($testimonial->avatar_path)
        <img class="img-preview" src="{{ (file_exists(public_path($testimonial->avatar_path)) && $testimonial->avatar_path) ? asset($testimonial->avatar_path) : asset('storage/' . $testimonial->avatar_path) }}" alt="Preview" style="border-radius: 50%; width: 80px; height: 80px;">
      @endif
      @error('image')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
      <label for="sort_order">Sort Order</label>
      <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', $testimonial->sort_order) }}" required>
      @error('sort_order')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div style="margin-top: 20px; display: flex; justify-content: flex-end;">
      <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Save Changes
      </button>
    </div>
  </form>
</div>
@endsection
