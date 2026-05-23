@extends('admin.layout')

@section('title', 'Add New Property')

@section('content')
<div class="content-header">
  <div>
    <h1>Add New Hotel Property</h1>
    <p class="subtitle">Enter details to feature a new hotel resort.</p>
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

  <form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-row">
      <div class="form-group">
        <label for="name">Hotel Name</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
        @error('name')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label for="rating">Rating (Stars)</label>
        <select id="rating" name="rating" class="form-control" required>
          <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>5 Stars</option>
          <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>4 Stars</option>
          <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>3 Stars</option>
          <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>2 Stars</option>
          <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>1 Star</option>
        </select>
        @error('rating')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="location">Location (City/Area)</label>
        <input type="text" id="location" name="location" class="form-control" placeholder="e.g. Riviera Maya" value="{{ old('location') }}" required>
        @error('location')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label for="country">Country</label>
        <input type="text" id="country" name="country" class="form-control" placeholder="e.g. Mexico" value="{{ old('country') }}" required>
        @error('country')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
    </div>

    <div class="form-group">
      <label for="description">Summary Description</label>
      <textarea id="description" name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
      @error('description')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="image">Featured Image</label>
        <input type="file" id="image" name="image" class="form-control" required>
        @error('image')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label for="sort_order">Sort Order</label>
        <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" required>
        @error('sort_order')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="view_url">Detail Page/Book URL</label>
        <input type="text" id="view_url" name="view_url" class="form-control" value="{{ old('view_url', '#') }}">
        @error('view_url')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label>Categories / Tabs</label>
        <div style="display: flex; flex-direction: column; gap: 8px; margin-top: 8px;">
          @foreach($categories as $cat)
            <label class="checkbox-label" style="font-weight: normal;">
              <input type="checkbox" name="categories[]" value="{{ $cat->id }}" {{ (is_array(old('categories')) && in_array($cat->id, old('categories'))) ? 'checked' : '' }}>
              {{ $cat->name }} (<code>{{ $cat->slug }}</code>)
            </label>
          @endforeach
        </div>
        @error('categories')<span style="color: var(--danger); font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>@enderror
      </div>
    </div>

    <div style="margin-top: 30px; display: flex; justify-content: flex-end;">
      <button type="submit" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Property
      </button>
    </div>
  </form>
</div>
@endsection
