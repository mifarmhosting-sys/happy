@extends('admin.layout')

@section('title', 'Membership Enquiries')

@section('content')
<div class="header">
    <h1>Membership Enquiries</h1>
</div>

<div class="card">
    <div class="card-header">
        <h2>All Enquiries</h2>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success" style="margin-bottom: 20px; padding: 15px; background: #d4edda; color: #155724; border-radius: 4px;">
            {{ session('success') }}
        </div>
    @endif

    @if($enquiries->isEmpty())
        <div class="empty-state" style="padding: 40px; text-align: center; color: #64748b;">
            <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 15px; color: #cbd5e1;"></i>
            <p>No membership enquiries received yet.</p>
        </div>
    @else
        <div style="overflow-x: auto;">
            <table class="table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #e2e8f0; background: #f8fafc; text-align: left;">
                        <th style="padding: 12px 15px;">Date</th>
                        <th style="padding: 12px 15px;">Name</th>
                        <th style="padding: 12px 15px;">Phone No</th>
                        <th style="padding: 12px 15px;">Email ID</th>
                        <th style="padding: 12px 15px;">Permanent Address</th>
                        <th style="padding: 12px 15px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($enquiries as $enquiry)
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 12px 15px;">{{ $enquiry->created_at->format('M d, Y h:i A') }}</td>
                            <td style="padding: 12px 15px; font-weight: 500;">{{ $enquiry->name }}</td>
                            <td style="padding: 12px 15px;">{{ $enquiry->phone }}</td>
                            <td style="padding: 12px 15px;"><a href="mailto:{{ $enquiry->email }}" style="color: #3b82f6; text-decoration: none;">{{ $enquiry->email }}</a></td>
                            <td style="padding: 12px 15px;">{{ $enquiry->address }}</td>
                            <td style="padding: 12px 15px;">
                                <form action="{{ route('admin.membership_enquiries.destroy', $enquiry->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this enquiry?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm" style="background: #ef4444; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
