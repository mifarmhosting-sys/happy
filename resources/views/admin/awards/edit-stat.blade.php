@extends('admin.layout')

@section('title', 'Edit Statistic Metric')

@section('content')
<div class="content-header">
  <div>
    <h1>Edit Statistic Metric</h1>
    <p class="subtitle">Modify metric values and label descriptions.</p>
  </div>
  <div>
    <a href="{{ route('admin.awards.index') }}" class="btn btn-secondary">
      <i class="fas fa-arrow-left"></i> Back to Achievements
    </a>
  </div>
</div>

<div class="card" style="max-width: 600px;">
  <div class="card-title">
    <span>Statistic Metric Details</span>
  </div>

  <form action="{{ route('admin.stats.update', $stat->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label for="value">Metric Value</label>
      <input type="text" id="value" name="value" class="form-control" value="{{ old('value', $stat->value) }}" required>
      @error('value')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
      <label for="label">Label Description</label>
      <input type="text" id="label" name="label" class="form-control" value="{{ old('label', $stat->label) }}" required>
      @error('label')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
      <label for="sort_order">Sort Order</label>
      <input type="number" id="sort_order" name="sort_order" class="form-control" value="{{ old('sort_order', $stat->sort_order) }}" required>
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
