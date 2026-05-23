@extends('admin.layout')

@section('title', 'Manage Achievements & Stats')

@section('content')
<div class="content-header">
  <div>
    <h1>Awards & Metric Statistics</h1>
    <p class="subtitle">Manage company accomplishments, awards, and quantitative stats featured on the Awards page.</p>
  </div>
</div>

<!-- TOP SECTION: AWARDS CRUD -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px; align-items: start; margin-bottom: 40px;">
  <!-- Left: Awards Table -->
  <div class="card" style="margin-bottom: 0;">
    <div class="card-title">
      <span>Featured Awards / Achievements</span>
    </div>

    <div class="table-responsive">
      @if($awards->isEmpty())
        <div style="text-align: center; padding: 40px; color: var(--text-muted);">
          <i class="fas fa-trophy" style="font-size: 3rem; margin-bottom: 15px; display: block;"></i>
          No awards added yet.
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
            @foreach($awards as $a)
              <tr>
                <td>
                  <div style="font-size: 1.25rem; color: #fbbf24; width: 36px; height: 36px; background-color: rgba(251, 191, 36, 0.1); border-radius: 6px; display: flex; align-items: center; justify-content: center; border: 1px solid var(--border);">
                    <i class="{{ $a->icon_class }}"></i>
                  </div>
                </td>
                <td><strong>{{ $a->title }}</strong></td>
                <td><span style="font-size: 0.88em; opacity: 0.9;">{{ Str::limit($a->description, 50) }}</span></td>
                <td>{{ $a->sort_order }}</td>
                <td>
                  <div class="actions-cell" style="justify-content: flex-end;">
                    <a href="{{ route('admin.awards.edit', $a->id) }}" class="btn btn-secondary btn-sm">
                      <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('admin.awards.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this award?');">
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

  <!-- Right: Quick Add Award Form -->
  <div class="card" style="margin-bottom: 0;">
    <div class="card-title">
      <span>Add New Award</span>
    </div>

    <form action="{{ route('admin.awards.store') }}" method="POST">
      @csrf

      <div class="form-group">
        <label for="title">Award Title</label>
        <input type="text" id="title" name="title" class="form-control" placeholder="e.g. Luxury Travel Innovator" required>
        @error('title')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>

      <div class="form-group">
        <label for="description">Award Description</label>
        <textarea id="description" name="description" class="form-control" rows="3" placeholder="Enter short award details..." required></textarea>
        @error('description')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>

      <div class="form-group">
        <label for="icon_class">FontAwesome Icon Class</label>
        <input type="text" id="icon_class" name="icon_class" class="form-control" value="fas fa-trophy" placeholder="e.g. fas fa-globe" required>
        <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 4px;">
          Common icons: <code>fas fa-trophy</code>, <code>fas fa-globe</code>, <code>fas fa-star</code>, <code>fas fa-plane-departure</code>, <code>fas fa-medal</code>, <code>fas fa-handshake</code>
        </div>
        @error('icon_class')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>

      <div class="form-group">
        <label for="sort_order">Sort Order</label>
        <input type="number" id="sort_order" name="sort_order" class="form-control" value="0" required>
        @error('sort_order')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>

      <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; margin-top: 10px;">
        <i class="fas fa-plus"></i> Add Award
      </button>
    </form>
  </div>
</div>

<!-- BOTTOM SECTION: STATS CRUD -->
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px; align-items: start;">
  <!-- Left: Stats Table -->
  <div class="card" style="margin-bottom: 0;">
    <div class="card-title">
      <span>Statistical Metrics</span>
    </div>

    <div class="table-responsive">
      @if($stats->isEmpty())
        <div style="text-align: center; padding: 40px; color: var(--text-muted);">
          <i class="fas fa-chart-bar" style="font-size: 3rem; margin-bottom: 15px; display: block;"></i>
          No statistics added yet.
        </div>
      @else
        <table>
          <thead>
            <tr>
              <th>Metric Value</th>
              <th>Label Description</th>
              <th>Sort Order</th>
              <th style="text-align: right;">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($stats as $s)
              <tr>
                <td><strong style="font-size: 1.2rem; color: var(--primary);">{{ $s->value }}</strong></td>
                <td>{{ $s->label }}</td>
                <td>{{ $s->sort_order }}</td>
                <td>
                  <div class="actions-cell" style="justify-content: flex-end;">
                    <a href="{{ route('admin.stats.edit', $s->id) }}" class="btn btn-secondary btn-sm">
                      <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('admin.stats.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this statistic metric?');">
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

  <!-- Right: Quick Add Stat Form -->
  <div class="card" style="margin-bottom: 0;">
    <div class="card-title">
      <span>Add New Statistic</span>
    </div>

    <form action="{{ route('admin.stats.store') }}" method="POST">
      @csrf

      <div class="form-group">
        <label for="value">Metric Value</label>
        <input type="text" id="value" name="value" class="form-control" placeholder="e.g. 50K+ or 5★" required>
        @error('value')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>

      <div class="form-group">
        <label for="label">Label Description</label>
        <input type="text" id="label" name="label" class="form-control" placeholder="e.g. Happy Travelers" required>
        @error('label')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>

      <div class="form-group">
        <label for="sort_order">Sort Order</label>
        <input type="number" id="sort_order" name="sort_order" class="form-control" value="0" required>
        @error('sort_order')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>

      <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; margin-top: 10px;">
        <i class="fas fa-plus"></i> Add Statistic
      </button>
    </form>
  </div>
</div>
@endsection
