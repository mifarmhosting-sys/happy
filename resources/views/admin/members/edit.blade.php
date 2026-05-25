@extends('admin.layout')

@section('title', 'Edit Member Details')

@section('content')
<div class="content-header">
    <div>
        <h1>Edit Member: {{ $member->customer_name }}</h1>
        <div class="subtitle">Set membership category, active dates, terms, and verify family profiles.</div>
    </div>
    <a href="{{ route('admin.members.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to List</a>
</div>

@if ($errors->any())
    <div class="alert alert-danger" style="margin-bottom: 30px;">
        <i class="fas fa-exclamation-circle"></i> Please resolve the following errors:
        <ul style="margin-top: 10px; padding-left: 20px; font-size: 0.9rem;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.members.update', $member->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid-3" style="grid-template-columns: 2fr 1fr; gap: 30px; align-items: start;">
        
        <div style="display: flex; flex-direction: column; gap: 30px;">
            <!-- Card 1: Core Profile Info -->
            <div class="card" style="margin-bottom: 0;">
                <div class="card-title">
                    <span><i class="fas fa-user-circle" style="color: var(--primary); margin-right: 8px;"></i> Personal Information</span>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="customer_name">Full Name *</label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control" value="{{ old('customer_name', $member->customer_name) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="number" name="age" id="age" class="form-control" value="{{ old('age', $member->age) }}" min="0">
                    </div>
                </div>

                <div class="form-row" style="margin-top: 20px;">
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $member->email) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile_1">Primary Phone Number *</label>
                        <input type="text" name="mobile_1" id="mobile_1" class="form-control" value="{{ old('mobile_1', $member->mobile_1) }}" required>
                    </div>
                </div>

                <div class="form-row" style="margin-top: 20px;">
                    <div class="form-group">
                        <label for="mobile_2">Secondary Phone Number</label>
                        <input type="text" name="mobile_2" id="mobile_2" class="form-control" value="{{ old('mobile_2', $member->mobile_2) }}">
                    </div>
                </div>

                <div class="form-group" style="margin-top: 20px;">
                    <label for="address">Billing Address</label>
                    <textarea name="address" id="address" class="form-control" rows="3">{{ old('address', $member->address) }}</textarea>
                </div>
            </div>

            <!-- Card 2: Family details -->
            <div class="card" style="margin-bottom: 0;">
                <div class="card-title">
                    <span><i class="fas fa-users" style="color: var(--primary); margin-right: 8px;"></i> Co-Customer & Kids</span>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="co_customer_name">Co-Customer Name</label>
                        <input type="text" name="co_customer_name" id="co_customer_name" class="form-control" value="{{ old('co_customer_name', $member->co_customer_name) }}">
                    </div>
                    <div class="form-group">
                        <label for="co_customer_age">Co-Customer Age</label>
                        <input type="number" name="co_customer_age" id="co_customer_age" class="form-control" value="{{ old('co_customer_age', $member->co_customer_age) }}" min="0">
                    </div>
                </div>

                <div class="form-row" style="margin-top: 20px;">
                    <div class="form-group">
                        <label for="kid_1_name">Kid 1 Name</label>
                        <input type="text" name="kid_1_name" id="kid_1_name" class="form-control" value="{{ old('kid_1_name', $member->kid_1_name) }}">
                    </div>
                    <div class="form-group">
                        <label for="kid_1_age">Kid 1 Age</label>
                        <input type="number" name="kid_1_age" id="kid_1_age" class="form-control" value="{{ old('kid_1_age', $member->kid_1_age) }}" min="0">
                    </div>
                </div>

                <div class="form-row" style="margin-top: 20px;">
                    <div class="form-group">
                        <label for="kid_2_name">Kid 2 Name</label>
                        <input type="text" name="kid_2_name" id="kid_2_name" class="form-control" value="{{ old('kid_2_name', $member->kid_2_name) }}">
                    </div>
                    <div class="form-group">
                        <label for="kid_2_age">Kid 2 Age</label>
                        <input type="number" name="kid_2_age" id="kid_2_age" class="form-control" value="{{ old('kid_2_age', $member->kid_2_age) }}" min="0">
                    </div>
                </div>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 30px;">
            <!-- Card 3: Membership Activation status -->
            <div class="card" style="margin-bottom: 0;">
                <div class="card-title">
                    <span><i class="fas fa-gem" style="color: var(--primary); margin-right: 8px;"></i> Membership Status</span>
                </div>

                <div class="form-group">
                    <label>Login Customer ID</label>
                    <input type="text" class="form-control" value="{{ $member->customer_id }}" readonly style="background-color: rgba(255,255,255,0.02); font-family: monospace;">
                </div>

                <div class="form-group">
                    <label for="membership_category">Membership Category *</label>
                    <input type="text" name="membership_category" id="membership_category" class="form-control" value="{{ old('membership_category', $member->membership_category) }}" placeholder="e.g. Platinum Club Elite" required>
                </div>

                <div class="form-group">
                    <label for="membership_issue_date">Activation / Issue Date</label>
                    <input type="date" name="membership_issue_date" id="membership_issue_date" class="form-control" value="{{ old('membership_issue_date', $member->membership_issue_date ? $member->membership_issue_date->format('Y-m-d') : '') }}">
                </div>

                <div class="form-group">
                    <label for="membership_expiry_date">Expiration Date</label>
                    <input type="date" name="membership_expiry_date" id="membership_expiry_date" class="form-control" value="{{ old('membership_expiry_date', $member->membership_expiry_date ? $member->membership_expiry_date->format('Y-m-d') : '') }}">
                </div>
            </div>

            <!-- Card 4: profile photo and terms -->
            <div class="card" style="margin-bottom: 0;">
                <div class="card-title">
                    <span><i class="fas fa-photo-video" style="color: var(--primary); margin-right: 8px;"></i> Media & Terms</span>
                </div>

                <div class="form-group">
                    <label for="profile_image">Profile Photo</label>
                    <input type="file" name="profile_image" id="profile_image" class="form-control">
                    @if($member->profile_image_path)
                        <img src="{{ asset($member->profile_image_path) }}" alt="" class="img-preview">
                    @endif
                </div>

                <div class="form-group">
                    <label for="membership_terms">Membership Terms & Conditions</label>
                    <textarea name="membership_terms" id="membership_terms" class="form-control" rows="5" placeholder="Specify details regarding nights limits, locations, resort rules...">{{ old('membership_terms', $member->membership_terms) }}</textarea>
                </div>
            </div>
        </div>

    </div>

    <!-- Submit row -->
    <div style="margin-top: 30px; display: flex; justify-content: flex-end; gap: 15px;">
        <a href="{{ route('admin.members.index') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
    </div>
</form>
@endsection
