@extends('admin.layout')

@section('title', 'Manage Blog Posts')

@section('content')
<div class="content-header">
  <div>
    <h1>Blog Posts</h1>
    <p class="subtitle">Create and manage dynamic articles on your website.</p>
  </div>
  <div>
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
      <i class="fas fa-plus"></i> Add New Post
    </a>
  </div>
</div>

<div class="card">
  <div class="card-title">
    <span>All Blog Posts</span>
  </div>

  <div class="table-responsive">
    @if($blogs->isEmpty())
      <div style="text-align: center; padding: 40px; color: var(--text-muted);">
        <i class="fas fa-newspaper" style="font-size: 3rem; margin-bottom: 15px; display: block;"></i>
        No blog posts added yet. Click "Add New Post" to write your first article!
      </div>
    @else
      <table>
        <thead>
          <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Category</th>
            <th>Author</th>
            <th>Published Date</th>
            <th style="text-align: right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($blogs as $post)
            <tr>
              <td>
                @if($post->image_path)
                  <img src="{{ (file_exists(public_path($post->image_path)) && $post->image_path) ? asset($post->image_path) : asset('storage/' . $post->image_path) }}" alt="" style="width: 80px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border);">
                @else
                  <div style="width: 80px; height: 50px; background-color: var(--border); border-radius: 4px; display: flex; align-items: center; justify-content: center; color: var(--text-muted);">
                    <i class="fas fa-image"></i>
                  </div>
                @endif
              </td>
              <td><strong>{{ $post->title }}</strong></td>
              <td><span class="badge" style="background-color: var(--card-bg); border: 1px solid var(--border); padding: 4px 8px; border-radius: 4px; font-size: 0.8rem;">{{ $post->category }}</span></td>
              <td><code>{{ $post->author }}</code></td>
              <td>{{ $post->published_at ? $post->published_at->format('M d, Y') : 'Draft' }}</td>
              <td>
                <div class="actions-cell" style="justify-content: flex-end;">
                  <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="btn btn-secondary btn-sm" style="background: none; border: 1px solid var(--border);">
                    <i class="fas fa-eye"></i> View
                  </a>
                  <a href="{{ route('admin.blogs.edit', $post->id) }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <form action="{{ route('admin.blogs.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog post?');">
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
@endsection
