@extends('admin.layout')

@section('title', 'Edit Destination')

@section('content')
<div class="content-header">
  <div>
    <h1>Edit Destination</h1>
    <p class="subtitle">Modify location name and imagery.</p>
  </div>
  <div>
    <a href="{{ route('admin.destinations.index') }}" class="btn btn-secondary">
      <i class="fas fa-arrow-left"></i> Back to Destinations
    </a>
  </div>
</div>

<div class="card" style="max-width: 600px;">
  <div class="card-title">
    <span>Destination Details</span>
  </div>

  <form action="{{ route('admin.destinations.update', $destination->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label for="name">Destination Name</label>
      <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $destination->name) }}" required>
      @error('name')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
      <label for="image">Replace Featured Image</label>
      <input type="file" id="image" name="image" class="form-control">
      @if($destination->image_path)
        <img class="img-preview" src="{{ (file_exists(public_path($destination->image_path)) && $destination->image_path) ? asset($destination->image_path) : asset('storage/' . $destination->image_path) }}" alt="Preview">
      @endif
      @error('image')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
      <label for="description">Description</label>
      <textarea id="description" name="description" class="form-control" rows="5" placeholder="Enter destination details...">{{ old('description', $destination->description) }}</textarea>
      @error('description')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
      <label for="sort_order">Sort Order</label>
      <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', $destination->sort_order) }}" required>
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
