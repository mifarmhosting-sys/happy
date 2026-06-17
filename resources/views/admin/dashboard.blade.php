@extends('admin.layout')

@section('title', 'Dashboard Overview')

@section('content')
<div class="content-header">
  <div>
    <h1>Dashboard</h1>
    <p class="subtitle">Welcome to the Happy Miles content management panel.</p>
  </div>
</div>

<!-- Stat metrics widgets grid -->
<div class="grid-3">
  <div class="stat-box">
    <div class="stat-icon">
      <i class="fas fa-envelope"></i>
    </div>
    <div>
      <div class="stat-number">{{ $unreadCount }}</div>
      <div class="stat-label">Unread Messages</div>
    </div>
  </div>

  <div class="stat-box">
    <div class="stat-icon">
      <i class="fas fa-hotel"></i>
    </div>
    <div>
      <div class="stat-number">{{ $hotelsCount }}</div>
      <div class="stat-label">Hotels/Properties</div>
    </div>
  </div>

  <div class="stat-box">
    <div class="stat-icon">
      <i class="fas fa-map-marked-alt"></i>
    </div>
    <div>
      <div class="stat-number">{{ $destinationsCount }}</div>
      <div class="stat-label">Destinations</div>
    </div>
  </div>
</div>

<!-- Inquiries table card -->
<div class="card">
  <div class="card-title">
    <span>Visitor Inquiries / Contact Messages</span>
  </div>

  <div class="table-responsive">
    @if($messages->isEmpty())
      <div style="text-align: center; padding: 40px; color: var(--text-muted);">
        <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 15px; display: block;"></i>
        No messages received yet.
      </div>
    @else
      <table>
        <thead>
          <tr>
            <th>Status</th>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Received</th>
            <th style="text-align: right;">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($messages as $msg)
            <tr>
              <td>
                @if(!$msg->read_at)
                  <span class="badge badge-unread">Unread</span>
                @else
                  <span class="badge badge-read">Read</span>
                @endif
              </td>
              <td><strong>{{ $msg->name }}</strong></td>
              <td>{{ $msg->email }}</td>
              <td>{{ $msg->subject ?? '(No Subject)' }}</td>
              <td>{{ $msg->created_at->diffForHumans() }}</td>
              <td>
                <div class="actions-cell" style="justify-content: flex-end;">
                  <a href="{{ route('admin.messages.view', $msg->id) }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-eye"></i> View
                  </a>
                  <form action="{{ route('admin.messages.delete', $msg->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
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
