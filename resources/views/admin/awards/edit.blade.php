@extends('admin.layout')

@section('title', 'Edit Award')

@section('content')
<div class="content-header">
  <div>
    <h1>Edit Award / Achievement</h1>
    <p class="subtitle">Modify achievement titles and icons.</p>
  </div>
  <div>
    <a href="{{ route('admin.awards.index') }}" class="btn btn-secondary">
      <i class="fas fa-arrow-left"></i> Back to Achievements
    </a>
  </div>
</div>

<div class="card" style="max-width: 600px;">
  <div class="card-title">
    <span>Award Details</span>
  </div>

  <form action="{{ route('admin.awards.update', $award->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label for="title">Award Title</label>
      <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $award->title) }}" required>
      @error('title')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
      <label for="description">Award Description</label>
      <textarea id="description" name="description" class="form-control" rows="4" required>{{ old('description', $award->description) }}</textarea>
      @error('description')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
      <label for="icon_class">FontAwesome Icon Class</label>
      <input type="text" id="icon_class" name="icon_class" class="form-control" value="{{ old('icon_class', $award->icon_class) }}" required>
      <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 4px;">
        Preview: <span style="font-size: 1.1rem; color: #fbbf24; margin-left: 5px;"><i class="{{ $award->icon_class }}"></i></span>
      </div>
      @error('icon_class')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
      <label for="sort_order">Sort Order</label>
      <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', $award->sort_order) }}" required>
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
