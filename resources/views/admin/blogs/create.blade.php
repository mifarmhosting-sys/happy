@extends('admin.layout')

@section('title', 'Add New Post')

@section('content')
<div class="content-header">
  <div>
    <h1>Add New Blog Post</h1>
    <p class="subtitle">Write a new article to feature on the blog section.</p>
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

  <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-row">
      <div class="form-group">
        <label for="title">Article Title</label>
        <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" placeholder="e.g. How Yoga Supports Everyday Wellness" required>
        @error('title')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label for="category">Category</label>
        <select id="category" name="category" class="form-control" required>
          <option value="Yoga & Mindfulness" {{ old('category') == 'Yoga & Mindfulness' ? 'selected' : '' }}>Yoga & Mindfulness</option>
          <option value="Community Cares" {{ old('category') == 'Community Cares' ? 'selected' : '' }}>Community Cares</option>
          <option value="Food and Nutrition" {{ old('category') == 'Food and Nutrition' ? 'selected' : '' }}>Food and Nutrition</option>
          <option value="Lifestyle" {{ old('category') == 'Lifestyle' ? 'selected' : '' }}>Lifestyle</option>
          <option value="Travel Tips" {{ old('category') == 'Travel Tips' ? 'selected' : '' }}>Travel Tips</option>
        </select>
        @error('category')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="author">Author Name</label>
        <input type="text" id="author" name="author" class="form-control" value="{{ old('author', 'site.admin') }}" required>
        @error('author')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
      <div class="form-group">
        <label for="image">Featured Image</label>
        <input type="file" id="image" name="image" class="form-control">
        @error('image')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
      </div>
    </div>

    <div class="form-group">
      <label for="summary">Excerpt / Excerpt Summary</label>
      <textarea id="summary" name="summary" class="form-control" rows="3" placeholder="A short 1-2 sentence preview text for the cards on the listing page." required>{{ old('summary') }}</textarea>
      @error('summary')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div class="form-group">
      <label for="content">Detailed Article Body</label>
      <textarea id="content" name="content" class="form-control" rows="12" placeholder="Write the main content of your blog post here. Use line breaks to separate paragraphs." required>{{ old('content') }}</textarea>
      @error('content')<span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>@enderror
    </div>

    <div style="margin-top: 30px; display: flex; justify-content: flex-end;">
      <button type="submit" class="btn btn-primary">
        <i class="fas fa-plus"></i> Publish Post
      </button>
    </div>
  </form>
</div>
@endsection
