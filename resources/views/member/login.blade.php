@extends('layouts.app')

@section('title', 'Member Login | ' . $settings->site_name)

@section('styles')
<style>
    .login-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: radial-gradient(circle at center, #0f243d 0%, #06101e 100%);
        padding: 40px 20px;
    }
    
    .login-card {
        background: rgba(11, 34, 64, 0.85);
        backdrop-filter: blur(10px);
        width: 100%;
        max-width: 450px;
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

    .login-card:hover {
        box-shadow: 0 0 35px 5px rgba(139, 92, 246, 0.55);
    }
    
    .login-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .login-header h2 {
        color: #ffffff;
        font-size: 26px;
        font-weight: 600;
        margin-bottom: 8px;
        letter-spacing: 0.5px;
    }
    
    .login-header p {
        color: #94a3b8;
        font-size: 14px;
        margin: 0;
    }
    
    .form-group {
        margin-bottom: 24px;
    }
    
    .form-label {
        display: block;
        color: #cbd5e1;
        font-size: 13px;
        font-weight: 500;
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
        font-size: 15px;
        transition: all 0.3s ease;
        box-sizing: border-box;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #00c8ff;
        box-shadow: 0 0 0 3px rgba(0, 200, 255, 0.2);
        background: rgba(15, 23, 42, 0.8);
    }
    
    .btn-login {
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
        margin-top: 10px;
    }
    
    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 200, 255, 0.4);
    }

    .btn-login:active {
        transform: translateY(0);
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
    
    .success-alert {
        background: rgba(16, 185, 129, 0.15);
        border-left: 4px solid #10b981;
        color: #a7f3d0;
        padding: 12px 16px;
        border-radius: 0 8px 8px 0;
        margin-bottom: 20px;
        font-size: 14.5px;
        line-height: 1.5;
    }
</style>
@endsection

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h2>Member Login</h2>
            <p>Access your premium travel vacation portal</p>
        </div>

        @if (session('success_registration'))
            <div class="success-alert">
                {!! session('success_registration') !!}
            </div>
        @endif

        @if ($errors->any())
            <div class="error-alert">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('member.login.submit') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="customer_id" class="form-label">Login ID / Customer ID</label>
                <input type="text" name="customer_id" id="customer_id" class="form-control" placeholder="e.g. PTC-1001" value="{{ old('customer_id') }}" required autofocus autocomplete="username">
            </div>
            
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required autocomplete="current-password">
            </div>

            <button type="submit" class="btn-login">Submit</button>
        </form>

        <div style="text-align: center; margin-top: 25px; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 15px;">
            <p style="color: #cbd5e1; font-size: 14px; margin: 0;">
                Don't have an account? <a href="{{ route('member.register') }}" style="color: #00c8ff; text-decoration: none; font-weight: bold;">Sign Up</a>
            </p>
        </div>
    </div>
</div>
@endsection
