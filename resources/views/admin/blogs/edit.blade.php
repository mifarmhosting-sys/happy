@extends('admin.layout')

@section('title', 'Edit Blog Post')

@section('content')
<div class="content-header">
  <div>
    <h1>Edit Blog Post</h1>
    <p class="subtitle">Modify details or update the image of your article.</p>
  </div>
  <div>
    <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">
      <i class="fas fa-arrow-left"></i> Back to Blog Posts
    </a>
  </div>
</div>

<div class="card">
  <div class="card-title">
    <span>Article Details</span>
  </div>

  <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-row">
      <div class="form-group">
        <label for="title">Article Title</label>
        <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
        @error('title')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label for="category">Category</label>
        <select id="category" name="category" class="form-control" required>
          <option value="Yoga & Mindfulness" {{ old('category', $blog->category) == 'Yoga & Mindfulness' ? 'selected' : '' }}>Yoga & Mindfulness</option>
          <option value="Community Cares" {{ old('category', $blog->category) == 'Community Cares' ? 'selected' : '' }}>Community Cares</option>
          <option value="Food and Nutrition" {{ old('category', $blog->category) == 'Food and Nutrition' ? 'selected' : '' }}>Food and Nutrition</option>
          <option value="Lifestyle" {{ old('category', $blog->category) == 'Lifestyle' ? 'selected' : '' }}>Lifestyle</option>
          <option value="Travel Tips" {{ old('category', $blog->category) == 'Travel Tips' ? 'selected' : '' }}>Travel Tips</option>
        </select>
        @error('category')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="author">Author Name</label>
        <input type="text" id="author" name="author" class="form-control" value="{{ old('author', $blog->author) }}" required>
        @error('author')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label for="image">Featured Image <span style="font-weight: normal; opacity: 0.7;">(Leave blank to keep current)</span></label>
        <input type="file" id="image" name="image" class="form-control">
        @error('image')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
        @if($blog->image_path)
          <div style="margin-top: 10px; display: flex; align-items: center; gap: 10px;">
            <span style="font-size: 0.85rem; color: var(--text-muted);">Current Image:</span>
            <img src="{{ (file_exists(public_path($blog->image_path)) && $blog->image_path) ? asset($blog->image_path) : asset('storage/' . $blog->image_path) }}" alt="" style="width: 100px; height: 60px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border);">
          </div>
        @endif
      </div>
    </div>

    <div class="form-group">
      <label for="summary">Excerpt / Excerpt Summary</label>
      <textarea id="summary" name="summary" class="form-control" rows="3" required>{{ old('summary', $blog->summary) }}</textarea>
      @error('summary')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
      <label for="content">Detailed Article Body</label>
      <textarea id="content" name="content" class="form-control" rows="12" required>{{ old('content', $blog->content) }}</textarea>
      @error('content')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div style="margin-top: 30px; display: flex; justify-content: flex-end; gap: 10px;">
      <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
      <button type="submit" class="btn btn-primary">
        <i class="fas fa-save"></i> Save Changes
      </button>
    </div>
  </form>
</div>
@endsection
