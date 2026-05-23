@extends('admin.layout')

@section('title', 'Manage Destinations')

@section('content')
<div class="content-header">
  <div>
    <h1>Destinations</h1>
    <p class="subtitle">Manage holiday locations featured on the home page.</p>
  </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px; align-items: start;">
  <!-- Left Side: Table List -->
  <div class="card" style="margin-bottom: 0;">
    <div class="card-title">
      <span>Active Destinations</span>
    </div>

    <div class="table-responsive">
      @if($destinations->isEmpty())
        <div style="text-align: center; padding: 40px; color: var(--text-muted);">
          <i class="fas fa-map-marked-alt" style="font-size: 3rem; margin-bottom: 15px; display: block;"></i>
          No destinations added yet.
        </div>
      @else
        <table>
          <thead>
            <tr>
              <th>Image</th>
              <th>Name</th>
              <th>Sort Order</th>
              <th style="text-align: right;">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($destinations as $dest)
              <tr>
                <td>
                  <img src="{{ (file_exists(public_path($dest->image_path)) && $dest->image_path) ? asset($dest->image_path) : asset('storage/' . $dest->image_path) }}" alt="" style="width: 80px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border);">
                </td>
                <td><strong>{{ $dest->name }}</strong></td>
                <td>{{ $dest->sort_order }}</td>
                <td>
                  <div class="actions-cell" style="justify-content: flex-end;">
                    <a href="{{ route('admin.destinations.edit', $dest->id) }}" class="btn btn-secondary btn-sm">
                      <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('admin.destinations.destroy', $dest->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this destination?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i> Delete
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </div>
  </div>

  <!-- Right Side: Quick Add Form -->
  <div class="card" style="margin-bottom: 0;">
    <div class="card-title">
      <span>Add New Destination</span>
    </div>

    <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
        <label for="name">Destination Name</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="e.g. Kashmir" required>
        @error('name')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>

      <div class="form-group">
        <label for="image">Featured Image</label>
        <input type="file" id="image" name="image" class="form-control" required>
        @error('image')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>

      <div class="form-group">
        <label for="sort_order">Sort Order</label>
        <input type="number" id="sort_order" name="sort_order" class="form-control" value="0" required>
        @error('sort_order')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>

      <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; margin-top: 10px;">
        <i class="fas fa-plus"></i> Add Destination
      </button>
    </form>
  </div>
</div>
@endsection
