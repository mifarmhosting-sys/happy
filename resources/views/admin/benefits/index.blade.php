@extends('admin.layout')

@section('title', 'Manage Benefits')

@section('content')
<div class="content-header">
  <div>
    <h1>Exclusive Benefits</h1>
    <p class="subtitle">Manage member advantages and benefits listed on Verticals page.</p>
  </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px; align-items: start;">
  <!-- Left Side: Benefits Table -->
  <div class="card" style="margin-bottom: 0;">
    <div class="card-title">
      <span>Active Exclusive Benefits</span>
    </div>

    <div class="table-responsive">
      @if($benefits->isEmpty())
        <div style="text-align: center; padding: 40px; color: var(--text-muted);">
          <i class="fas fa-gift" style="font-size: 3rem; margin-bottom: 15px; display: block;"></i>
          No benefits added yet.
        </div>
      @else
        <table>
          <thead>
            <tr>
              <th>Icon</th>
              <th>Title</th>
              <th>Description Snippet</th>
              <th>Sort Order</th>
              <th style="text-align: right;">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($benefits as $b)
              <tr>
                <td>
                  <div style="width: 42px; height: 42px; background-color: rgba(16, 185, 129, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; border: 1px solid var(--border);">
                    <img src="{{ (file_exists(public_path($b->icon_path)) && $b->icon_path) ? asset($b->icon_path) : asset('storage/' . $b->icon_path) }}" alt="" style="width: 24px; height: 24px; object-fit: contain;">
                  </div>
                </td>
                <td><strong>{{ $b->title }}</strong></td>
                <td><span style="font-size: 0.88em; opacity: 0.9;">{{ Str::limit($b->description, 50) }}</span></td>
                <td>{{ $b->sort_order }}</td>
                <td>
                  <div class="actions-cell" style="justify-content: flex-end;">
                    <a href="{{ route('admin.benefits.edit', $b->id) }}" class="btn btn-secondary btn-sm">
                      <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('admin.benefits.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this benefit item?');">
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

  <!-- Right Side: Quick Add Benefit -->
  <div class="card" style="margin-bottom: 0;">
    <div class="card-title">
      <span>Add New Benefit</span>
    </div>

    <form action="{{ route('admin.benefits.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
        <label for="title">Benefit Title</label>
        <input type="text" id="title" name="title" class="form-control" placeholder="e.g. Flexibility" required>
        @error('title')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>

      <div class="form-group">
        <label for="description">Benefit Description</label>
        <textarea id="description" name="description" class="form-control" rows="4" placeholder="Enter short benefit summary..." required></textarea>
        @error('description')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>

      <div class="form-group">
        <label for="icon">Icon File (SVG / PNG preferred)</label>
        <input type="file" id="icon" name="icon" class="form-control">
        @error('icon')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>

      <div class="form-group">
        <label for="sort_order">Sort Order</label>
        <input type="number" id="sort_order" name="sort_order" class="form-control" value="0" required>
        @error('sort_order')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>

      <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; margin-top: 10px;">
        <i class="fas fa-plus"></i> Add Benefit
      </button>
    </form>
  </div>
</div>
@endsection
