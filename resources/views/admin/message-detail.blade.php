@extends('admin.layout')

@section('title', 'Inquiry Details')

@section('content')
<div class="content-header">
  <div>
    <h1>Inquiry Details</h1>
    <p class="subtitle">Viewing message from {{ $message->name }}</p>
  </div>
  <div>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
      <i class="fas fa-arrow-left"></i> Back to Inbox
    </a>
  </div>
</div>

<div class="card">
  <div class="card-title" style="border-bottom: 1px solid var(--border); padding-bottom: 15px;">
    <span>{{ $message->subject ?? '(No Subject)' }}</span>
    <span class="badge {{ !$message->read_at ? 'badge-unread' : 'badge-read' }}" style="font-size: 0.85rem;">
      {{ !$message->read_at ? 'Unread' : 'Read' }}
    </span>
  </div>

  <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px; margin-top: 20px;">
    <!-- Sender Info -->
    <div style="border-right: 1px solid var(--border); padding-right: 20px;">
      <h3 style="margin-bottom: 15px; font-size: 1rem; color: var(--primary);">Sender Information</h3>
      
      <div style="margin-bottom: 12px;">
        <strong style="font-size: 0.85rem; color: var(--text-muted); display: block;">Full Name</strong>
        <span>{{ $message->name }}</span>
      </div>

      <div style="margin-bottom: 12px;">
        <strong style="font-size: 0.85rem; color: var(--text-muted); display: block;">Email Address</strong>
        <a href="mailto:{{ $message->email }}" style="color: var(--primary); text-decoration: none;">{{ $message->email }}</a>
      </div>

      <div style="margin-bottom: 12px;">
        <strong style="font-size: 0.85rem; color: var(--text-muted); display: block;">Phone Number</strong>
        <span>{{ $message->phone ?? '(Not provided)' }}</span>
      </div>

      <div style="margin-bottom: 12px;">
        <strong style="font-size: 0.85rem; color: var(--text-muted); display: block;">Submitted Date</strong>
        <span>{{ $message->created_at->format('M d, Y \a\t h:i A') }} ({{ $message->created_at->diffForHumans() }})</span>
      </div>
    </div>

    <!-- Message Body -->
    <div>
      <h3 style="margin-bottom: 15px; font-size: 1rem; color: var(--primary);">Message Content</h3>
      <div style="background-color: #0b0f19; border: 1px solid var(--border); border-radius: 8px; padding: 20px; min-height: 180px; white-space: pre-wrap; font-size: 1rem; line-height: 1.6;">{{ $message->message }}</div>
      
      <div style="margin-top: 30px; display: flex; gap: 12px; justify-content: flex-end;">
        <a href="mailto:{{ $message->email }}?subject=RE: {{ $message->subject }}" class="btn btn-primary">
          <i class="fas fa-reply"></i> Reply via Email
        </a>
        <form action="{{ route('admin.messages.delete', $message->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">
            <i class="fas fa-trash"></i> Delete Message
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
