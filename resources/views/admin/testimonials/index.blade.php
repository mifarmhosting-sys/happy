@extends('admin.layout')

@section('title', 'Manage Testimonials')

@section('content')
<div class="content-header">
  <div>
    <h1>Testimonials</h1>
    <p class="subtitle">Manage member reviews and ratings displayed on the site.</p>
  </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px; align-items: start;">
  <!-- Left Side: Testimonials Table -->
  <div class="card" style="margin-bottom: 0;">
    <div class="card-title">
      <span>Active Testimonials</span>
    </div>

    <div class="table-responsive">
      @if($testimonials->isEmpty())
        <div style="text-align: center; padding: 40px; color: var(--text-muted);">
          <i class="fas fa-comments" style="font-size: 3rem; margin-bottom: 15px; display: block;"></i>
          No testimonials added yet.
        </div>
      @else
        <table>
          <thead>
            <tr>
              <th>Avatar</th>
              <th>Author</th>
              <th>Role/Date</th>
              <th>Snippet</th>
              <th>Location Placement</th>
              <th style="text-align: right;">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($testimonials as $test)
              <tr>
                <td>
                  <img src="{{ (file_exists(public_path($test->avatar_path)) && $test->avatar_path) ? asset($test->avatar_path) : asset('storage/' . $test->avatar_path) }}" alt="" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%; border: 1px solid var(--border);">
                </td>
                <td><strong>{{ $test->author }}</strong></td>
                <td>{{ $test->role ?? '(No details)' }}</td>
                <td><span style="font-style: italic; font-size: 0.85em; opacity: 0.95;">{{ Str::limit($test->quote, 50) }}</span></td>
                <td>
                  <span class="badge" style="background-color: {{ $test->type == 'home' ? '#047857' : '#1e3a8a' }}; color: #fff;">
                    {{ $test->type == 'home' ? 'Home page slider' : 'About page grid' }}
                  </span>
                </td>
                <td>
                  <div class="actions-cell" style="justify-content: flex-end;">
                    <a href="{{ route('admin.testimonials.edit', $test->id) }}" class="btn btn-secondary btn-sm">
                      <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('admin.testimonials.destroy', $test->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this testimonial?');">
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

  <!-- Right Side: Quick Add Testimonial -->
  <div class="card" style="margin-bottom: 0;">
    <div class="card-title">
      <span>Add Testimonial</span>
    </div>

    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
        <label for="author">Author Name</label>
        <input type="text" id="author" name="author" class="form-control" placeholder="e.g. Debjit Chatterjee" required>
        @error('author')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>

      <div class="form-group">
        <label for="role">Role / Detail (e.g. 'Member since 2022')</label>
        <input type="text" id="role" name="role" class="form-control" placeholder="e.g. Member since 2022">
        @error('role')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>

      <div class="form-group">
        <label for="quote">Quote Content</label>
        <textarea id="quote" name="quote" class="form-control" rows="4" placeholder="Enter review/quote text..." required></textarea>
        @error('quote')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>

      <div class="form-group">
        <label for="type">Placement Type</label>
        <select id="type" name="type" class="form-control" required>
          <option value="home">Home Page (Slide with details)</option>
          <option value="about">About Page (Grid layout card)</option>
        </select>
        @error('type')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>

      <div class="form-group">
        <label for="image">Avatar / Review Image</label>
        <input type="file" id="image" name="image" class="form-control">
        @error('image')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>

      <div class="form-group">
        <label for="sort_order">Sort Order</label>
        <input type="number" id="sort_order" name="sort_order" class="form-control" value="0" required>
        @error('sort_order')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>

      <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; margin-top: 10px;">
        <i class="fas fa-plus"></i> Add Testimonial
      </button>
    </form>
  </div>
</div>
@endsection
