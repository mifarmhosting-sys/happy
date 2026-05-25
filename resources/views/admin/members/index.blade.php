@extends('admin.layout')

@section('title', 'Registered Members')

@section('content')
<div class="content-header">
    <div>
        <h1>Registered Members</h1>
        <div class="subtitle">View and activate user holiday packages.</div>
    </div>
</div>

<div class="card">
    <div class="card-title">
        <span>Members List</span>
    </div>
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Customer ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $member)
                    <tr>
                        <td>
                            <img src="{{ $member->profile_image_path ? asset($member->profile_image_path) : asset('images/profile.jpg') }}" alt="" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid var(--border);">
                        </td>
                        <td><code>{{ $member->customer_id }}</code></td>
                        <td><strong>{{ $member->customer_name }}</strong></td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->mobile_1 }}</td>
                        <td>
                            <span class="badge {{ $member->membership_category === 'New Member' ? 'badge-read' : 'badge-unread' }}" style="background-color: rgba(56, 189, 248, 0.15); color: #38bdf8;">
                                {{ $member->membership_category }}
                            </span>
                        </td>
                        <td>
                            @if($member->membership_issue_date && $member->membership_expiry_date)
                                <span class="badge badge-unread" style="background-color: rgba(16, 185, 129, 0.15); color: #34d399;">Active</span>
                            @else
                                <span class="badge badge-danger" style="background-color: rgba(239, 68, 68, 0.15); color: #f87171;">Pending Activation</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions-cell">
                                <a href="{{ route('admin.members.edit', $member->id) }}" class="btn btn-secondary btn-sm" title="Edit Member"><i class="fas fa-edit"></i> Edit</a>
                                <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this member account?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Member"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; color: var(--text-muted); padding: 40px 0;">
                            <i class="fas fa-users-slash" style="font-size: 2.5rem; margin-bottom: 15px; display: block;"></i>
                            No members registered yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
