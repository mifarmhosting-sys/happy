@extends('layouts.app')

@section('title', 'My Profile | ' . $settings->site_name)

@section('styles')
<style>
    .profile-container {
        background: #0f172a;
        color: #e2e8f0;
        min-height: 90vh;
        padding: 60px 20px;
    }
    
    .profile-card {
        background: #1e293b;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.05);
        max-width: 900px;
        margin: 0 auto;
        overflow: hidden;
    }
    
    .profile-header {
        background: linear-gradient(135deg, #0b2240 0%, #1e1b4b 100%);
        padding: 30px 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 2px solid rgba(255, 255, 255, 0.05);
        flex-wrap: wrap;
        gap: 20px;
    }
    
    .profile-user-info {
        display: flex;
        align-items: center;
        gap: 20px;
    }
    
    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #00c8ff;
        background: #0b2240;
    }
    
    .profile-title h1 {
        font-size: 24px;
        color: #ffffff;
        margin: 0 0 5px 0;
        font-weight: 600;
    }
    
    .profile-title span {
        color: #00c8ff;
        font-size: 14px;
        font-weight: 500;
        letter-spacing: 0.5px;
    }
    
    .profile-logo {
        height: 45px;
        width: auto;
    }
    
    .profile-body {
        padding: 40px;
    }
    
    .profile-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        margin-bottom: 40px;
    }
    
    .info-section {
        background: rgba(15, 23, 42, 0.4);
        padding: 24px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.03);
    }
    
    .section-header {
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #38bdf8;
        margin-bottom: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        padding-bottom: 8px;
    }
    
    .info-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 14.5px;
    }
    
    .info-row:last-child {
        margin-bottom: 0;
    }
    
    .info-label {
        color: #94a3b8;
        font-weight: 500;
    }
    
    .info-value {
        color: #f8fafc;
        font-weight: 600;
        text-align: right;
    }
    
    .terms-box {
        background: rgba(15, 23, 42, 0.4);
        padding: 24px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.03);
        margin-bottom: 40px;
    }
    
    .terms-content {
        font-size: 13.5px;
        color: #cbd5e1;
        line-height: 1.6;
        max-height: 150px;
        overflow-y: auto;
        padding-right: 10px;
    }
    
    /* Custom Scrollbar for terms */
    .terms-content::-webkit-scrollbar {
        width: 6px;
    }
    .terms-content::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.02);
    }
    .terms-content::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 3px;
    }
    
    .action-container {
        text-align: center;
    }
    
    .btn-booking {
        display: inline-block;
        padding: 16px 40px;
        background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%);
        color: #ffffff;
        font-size: 18px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-radius: 50px;
        text-decoration: none;
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.35);
        transition: all 0.3s ease;
    }
    
    .btn-booking:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(239, 68, 68, 0.5);
        background: linear-gradient(135deg, #f87171 0%, #dc2626 100%);
    }

    .btn-booking:active {
        transform: translateY(-1px);
    }
</style>
@endsection

@section('content')
<div class="profile-container">
    <div class="profile-card">
        <!-- Header: Profile Avatar (Left), Logo (Right) -->
        <div class="profile-header">
            <div class="profile-user-info">
                <img src="{{ $member->profile_image_path ? asset($member->profile_image_path) : asset('images/profile.jpg') }}" alt="{{ $member->customer_name }}" class="profile-avatar">
                <div class="profile-title">
                    <h1>{{ $member->customer_name }}</h1>
                    <span>CUSTOMER ID: <code>{{ $member->customer_id }}</code></span>
                </div>
            </div>
            <img src="{{ asset($settings->logo_path ? 'storage/' . $settings->logo_path : 'images/Premium.png') }}" alt="{{ $settings->site_name }}" class="profile-logo">
        </div>

        <div class="profile-body">
            
            <div class="profile-grid">
                
                <!-- Section A: Personal & Family Information -->
                <div class="info-section">
                    <div class="section-header"><i class="fa fa-users" style="margin-right: 8px;"></i>Personal & Family</div>
                    
                    <div class="info-row">
                        <span class="info-label">Lead Member:</span>
                        <span class="info-value">{{ $member->customer_name }}{{ $member->age ? ' (Age: ' . $member->age . ')' : '' }}</span>
                    </div>
                    
                    @if($member->co_customer_name)
                    <div class="info-row">
                        <span class="info-label">Co-Customer:</span>
                        <span class="info-value">{{ $member->co_customer_name }} (Age: {{ $member->co_customer_age }})</span>
                    </div>
                    @endif
                    
                    @if($member->kid_1_name)
                    <div class="info-row">
                        <span class="info-label">Kid 1:</span>
                        <span class="info-value">{{ $member->kid_1_name }} (Age: {{ $member->kid_1_age }})</span>
                    </div>
                    @endif

                    @if($member->kid_2_name)
                    <div class="info-row">
                        <span class="info-label">Kid 2:</span>
                        <span class="info-value">{{ $member->kid_2_name }} (Age: {{ $member->kid_2_age }})</span>
                    </div>
                    @endif
                </div>
                
                <!-- Section B: Contact Information -->
                <div class="info-section">
                    <div class="section-header"><i class="fa fa-address-book" style="margin-right: 8px;"></i>Contact Details</div>
                    
                    <div class="info-row">
                        <span class="info-label">E-Mail Address:</span>
                        <span class="info-value">{{ $member->email }}</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Mobile 1:</span>
                        <span class="info-value">{{ $member->mobile_1 }}</span>
                    </div>
                    
                    @if($member->mobile_2)
                    <div class="info-row">
                        <span class="info-label">Mobile 2:</span>
                        <span class="info-value">{{ $member->mobile_2 }}</span>
                    </div>
                    @endif
                    
                    <div class="info-row">
                        <span class="info-label">Address:</span>
                        <span class="info-value" style="font-size: 13px; max-width: 60%;">{{ $member->address ?? 'Not specified' }}</span>
                    </div>
                </div>

                <!-- Section C: Membership Information -->
                <div class="info-section" style="grid-column: span 1; grid-column-end: -1;">
                    <div class="section-header"><i class="fa fa-gem" style="margin-right: 8px;"></i>Membership Status</div>
                    
                    <div class="info-row">
                        <span class="info-label">Category:</span>
                        <span class="info-value" style="color: #38bdf8;">{{ $member->membership_category ?? 'New Member' }}</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Issue Date:</span>
                        <span class="info-value">{{ $member->membership_issue_date ? $member->membership_issue_date->format('d M, Y') : 'Pending Activation' }}</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Expiry Date:</span>
                        <span class="info-value">{{ $member->membership_expiry_date ? $member->membership_expiry_date->format('d M, Y') : 'Pending Activation' }}</span>
                    </div>
                </div>

            </div>

            <!-- Section D: Membership Terms -->
            <div class="terms-box">
                <div class="section-header"><i class="fa fa-file-contract" style="margin-right: 8px;"></i>Membership Terms & Conditions</div>
                <div class="terms-content">
                    {!! $member->membership_terms ? nl2br(e($member->membership_terms)) : 'No custom terms specified for this membership.' !!}
                </div>
            </div>

            <!-- Action Button -->
            <div class="action-container">
                <a href="{{ route('member.booking') }}" class="btn-booking">
                    <i class="fa fa-plane-departure" style="margin-right: 10px;"></i>Book Your Holidays
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
