@extends('admin.layout')

@section('title', 'Manage Blog Comments')

@section('content')
<div class="content-header">
  <div>
    <h1>Blog Comments</h1>
    <p class="subtitle">Review, approve, and manage comments submitted by visitors.</p>
  </div>
</div>

<div class="card">
  <div class="card-title">
    <span>All Comments</span>
  </div>

  <div class="table-responsive">
    @if($comments->isEmpty())
      <div style="text-align: center; padding: 40px; color: var(--text-muted);">
        <i class="fas fa-comments" style="font-size: 3rem; margin-bottom: 15px; display: block;"></i>
        No comments have been posted yet.
      </div>
    @else
      <table>
        <thead>
          <tr>
            <th>Status</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Blog Post</th>
            <th>Date</th>
            <th style="text-align: right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($comments as $comment)
            <tr>
              <td>
                @if($comment->is_approved)
                  <span class="badge badge-unread" style="background-color: rgba(16, 185, 129, 0.2); color: #34d399;">Approved</span>
                @else
                  <span class="badge badge-read" style="background-color: rgba(245, 158, 11, 0.2); color: #fbbf24;">Pending</span>
                @endif
              </td>
              <td>
                <strong>{{ $comment->name }}</strong><br>
                <small style="color: var(--text-muted);">{{ $comment->email }}</small>
              </td>
              <td style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                {{ $comment->comment }}
              </td>
              <td>
                @if($comment->post)
                  <a href="{{ route('blog.show', $comment->post->slug) }}" target="_blank" style="color: var(--primary); text-decoration: none;">
                    {{ \Illuminate\Support\Str::limit($comment->post->title, 30) }}
                  </a>
                @else
                  <span style="color: var(--text-muted);">Post Deleted</span>
                @endif
              </td>
              <td>{{ $comment->created_at->format('M d, Y g:i A') }}</td>
              <td>
                <div class="actions-cell" style="justify-content: flex-end;">
                  @if(!$comment->is_approved)
                    <form action="{{ route('admin.blogs.comments.approve', $comment->id) }}" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-check"></i> Approve
                      </button>
                    </form>
                  @endif
                  <form action="{{ route('admin.blogs.comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
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
