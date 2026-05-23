@extends('admin.layout')

@section('title', 'Edit Property')

@section('content')
<div class="content-header">
  <div>
    <h1>Edit Hotel Property</h1>
    <p class="subtitle">Modify details for {{ $hotel->name }}</p>
  </div>
  <div>
    <a href="{{ route('admin.hotels.index') }}" class="btn btn-secondary">
      <i class="fas fa-arrow-left"></i> Back to Properties
    </a>
  </div>
</div>

<div class="card">
  <div class="card-title">
    <span>Property Information</span>
  </div>

  <form action="{{ route('admin.hotels.update', $hotel->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-row">
      <div class="form-group">
        <label for="name">Hotel Name</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $hotel->name) }}" required>
        @error('name')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label for="rating">Rating (Stars)</label>
        <select id="rating" name="rating" class="form-control" required>
          <option value="5" {{ old('rating', $hotel->rating) == 5 ? 'selected' : '' }}>5 Stars</option>
          <option value="4" {{ old('rating', $hotel->rating) == 4 ? 'selected' : '' }}>4 Stars</option>
          <option value="3" {{ old('rating', $hotel->rating) == 3 ? 'selected' : '' }}>3 Stars</option>
          <option value="2" {{ old('rating', $hotel->rating) == 2 ? 'selected' : '' }}>2 Stars</option>
          <option value="1" {{ old('rating', $hotel->rating) == 1 ? 'selected' : '' }}>1 Star</option>
        </select>
        @error('rating')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="location">Location (City/Area)</label>
        <input type="text" id="location" name="location" class="form-control" value="{{ old('location', $hotel->location) }}" required>
        @error('location')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label for="country">Country</label>
        <input type="text" id="country" name="country" class="form-control" value="{{ old('country', $hotel->country) }}" required>
        @error('country')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
    </div>

    <div class="form-group">
      <label for="description">Summary Description</label>
      <textarea id="description" name="description" class="form-control" rows="4" required>{{ old('description', $hotel->description) }}</textarea>
      @error('description')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="image">Replace Featured Image</label>
        <input type="file" id="image" name="image" class="form-control">
        @if($hotel->image_path)
          <img class="img-preview" src="{{ (file_exists(public_path($hotel->image_path)) && $hotel->image_path) ? asset($hotel->image_path) : asset('storage/' . $hotel->image_path) }}" alt="Preview">
        @endif
        @error('image')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label for="sort_order">Sort Order</label>
        <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', $hotel->sort_order) }}" required>
        @error('sort_order')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="view_url">Detail Page/Book URL</label>
        <input type="text" id="view_url" name="view_url" class="form-control" value="{{ old('view_url', $hotel->view_url) }}">
        @error('view_url')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label>Categories / Tabs</label>
        <div style="display: flex; flex-direction: column; gap: 8px; margin-top: 8px;">
          @foreach($categories as $cat)
            <label class="checkbox-label" style="font-weight: normal;">
              <input type="checkbox" name="categories[]" value="{{ $cat->id }}" 
                {{ (is_array(old('categories', $hotel->categories->pluck('id')->toArray())) && in_array($cat->id, old('categories', $hotel->categories->pluck('id')->toArray()))) ? 'checked' : '' }}>
              {{ $cat->name }} (<code>{{ $cat->slug }}</code>)
            </label>
          @endforeach
        </div>
        @error('categories')<span style="color: var(--danger); font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>@enderror
      </div>
    </div>

    <div style="margin-top: 30px; display: flex; justify-content: flex-end;">
      <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Save Changes
      </button>
    </div>
  </form>
</div>
@endsection
