@extends('layouts.app')

@section('title', 'Member Registration | ' . $settings->site_name)

@section('styles')
<style>
    .register-container {
        min-height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: radial-gradient(circle at center, #0f243d 0%, #06101e 100%);
        padding: 60px 20px;
    }
    
    .register-card {
        background: rgba(11, 34, 64, 0.85);
        backdrop-filter: blur(10px);
        width: 100%;
        max-width: 500px;
        padding: 40px;
        border-radius: 16px;
        position: relative;
        /* Neon glowing border effect (Cyan to Purple gradient) */
        border: 2px solid transparent;
        background-image: linear-gradient(rgba(11, 34, 64, 0.85), rgba(11, 34, 64, 0.85)), linear-gradient(135deg, #00c8ff, #8b5cf6);
        background-origin: border-box;
        background-clip: padding-box, border-box;
        box-shadow: 0 0 25px 2px rgba(0, 200, 255, 0.45);
        transition: box-shadow 0.3s ease;
    }

    .register-card:hover {
        box-shadow: 0 0 35px 5px rgba(139, 92, 246, 0.55);
    }
    
    .register-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .register-header h2 {
        color: #ffffff;
        font-size: 26px;
        font-weight: 600;
        margin-bottom: 8px;
        letter-spacing: 0.5px;
    }
    
    .register-header p {
        color: #94a3b8;
        font-size: 14px;
        margin: 0;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-label {
        display: block;
        color: #cbd5e1;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .form-control {
        width: 100%;
        background: rgba(15, 23, 42, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 12px 16px;
        color: #ffffff;
        border-radius: 8px;
        font-size: 14.5px;
        transition: all 0.3s ease;
        box-sizing: border-box;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #00c8ff;
        box-shadow: 0 0 0 3px rgba(0, 200, 255, 0.2);
        background: rgba(15, 23, 42, 0.8);
    }
    
    .btn-register {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #00c8ff 0%, #8b5cf6 100%);
        border: none;
        color: #ffffff;
        font-size: 15px;
        font-weight: 600;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-top: 15px;
    }
    
    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 200, 255, 0.4);
    }
    
    .error-alert {
        background: rgba(239, 68, 68, 0.15);
        border-left: 4px solid #ef4444;
        color: #fca5a5;
        padding: 12px 16px;
        border-radius: 0 8px 8px 0;
        margin-bottom: 20px;
        font-size: 14px;
    }
</style>
@endsection

@section('content')
<div class="register-container">
    <div class="register-card">
        <div class="register-header">
            <h2>Member Sign Up</h2>
            <p>Join the Premium Travel Club holiday portal</p>
        </div>

        @if ($errors->any())
            <div class="error-alert">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('member.register.submit') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="customer_name" class="form-label">Full Name</label>
                <input type="text" name="customer_name" id="customer_name" class="form-control" placeholder="e.g. John Doe" value="{{ old('customer_name') }}" required autofocus autocomplete="name">
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="e.g. john@example.com" value="{{ old('email') }}" required autocomplete="email">
            </div>

            <div class="form-group">
                <label for="mobile_1" class="form-label">Phone Number</label>
                <input type="text" name="mobile_1" id="mobile_1" class="form-control" placeholder="e.g. +91 98765 43210" value="{{ old('mobile_1') }}" required autocomplete="tel">
            </div>
            
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required autocomplete="new-password">
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="••••••••" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn-register">Submit</button>
        </form>

        <div style="text-align: center; margin-top: 25px; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 15px;">
            <p style="color: #cbd5e1; font-size: 14px; margin: 0;">
                Already have an account? <a href="{{ route('member.login') }}" style="color: #00c8ff; text-decoration: none; font-weight: bold;">Log In</a>
            </p>
        </div>
    </div>
</div>
@endsection
