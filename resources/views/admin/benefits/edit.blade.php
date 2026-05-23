@extends('admin.layout')

@section('title', 'Edit Benefit')

@section('content')
<div class="content-header">
  <div>
    <h1>Edit Benefit</h1>
    <p class="subtitle">Modify benefit title, details, and icon.</p>
  </div>
  <div>
    <a href="{{ route('admin.benefits.index') }}" class="btn btn-secondary">
      <i class="fas fa-arrow-left"></i> Back to Benefits
    </a>
  </div>
</div>

<div class="card" style="max-width: 600px;">
  <div class="card-title">
    <span>Benefit Details</span>
  </div>

  <form action="{{ route('admin.benefits.update', $benefit->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label for="title">Benefit Title</label>
      <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $benefit->title) }}" required>
      @error('title')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
      <label for="description">Benefit Description</label>
      <textarea id="description" name="description" class="form-control" rows="5" required>{{ old('description', $benefit->description) }}</textarea>
      @error('description')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
      <label for="icon">Replace Icon File</label>
      <input type="file" id="icon" name="icon" class="form-control">
      @if($benefit->icon_path)
        <div style="margin-top: 10px; width: 64px; height: 64px; background-color: rgba(16, 185, 129, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; border: 1px solid var(--border);">
          <img src="{{ (file_exists(public_path($benefit->icon_path)) && $benefit->icon_path) ? asset($benefit->icon_path) : asset('storage/' . $benefit->icon_path) }}" alt="" style="width: 32px; height: 32px; object-fit: contain;">
        </div>
      @endif
      @error('icon')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
      <label for="sort_order">Sort Order</label>
      <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', $benefit->sort_order) }}" required>
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
