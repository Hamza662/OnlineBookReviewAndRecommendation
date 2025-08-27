@extends('layouts.app')

@section('main')
<style>
    .login-container {
        min-height: 100vh;
        /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        position: relative;
        overflow: hidden;
    }

    .login-container::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.8" fill="white" opacity="0.08"/><circle cx="10" cy="60" r="0.6" fill="white" opacity="0.06"/><circle cx="90" cy="40" r="0.9" fill="white" opacity="0.09"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        animation: float 20s ease-in-out infinite;
        pointer-events: none;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px) rotate(0deg);
        }

        50% {
            transform: translateY(-20px) rotate(2deg);
        }
    }

    .login-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 24px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        padding: 40px;
        width: 100%;
        max-width: 450px;
        position: relative;
        animation: slideUp 0.6s ease-out;
        z-index: 1;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-header {
        text-align: center;
        margin-bottom: 35px;
    }

    .login-title {
        font-size: 2.2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }

    .login-subtitle {
        color: #6b7280;
        font-size: 1rem;
        font-weight: 400;
    }

    .form-floating {
        position: relative;
        margin-bottom: 24px;
    }

    .form-control {
        background: rgba(249, 250, 251, 0.8);
        border: 2px solid rgba(229, 231, 235, 0.5);
        border-radius: 16px;
        padding: 16px 20px;
        font-size: 16px;
        transition: all 0.3s ease;
        height: auto;
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.9);
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .form-floating label {
        padding: 16px 20px;
        color: #6b7280;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .form-floating .form-control:focus+label,
    .form-floating .form-control:not(:placeholder-shown)+label {
        transform: scale(0.85) translateY(-14px) translateX(-4px);
        color: #667eea;
        font-weight: 600;
    }

    .login-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 16px;
        padding: 16px 24px;
        font-size: 16px;
        font-weight: 600;
        color: white;
        width: 100%;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .login-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .login-btn:hover::before {
        left: 100%;
    }

    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }

    .login-btn:active {
        transform: translateY(0);
    }

    .forgot-password-link {
        display: inline-block;
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        padding: 12px 24px;
        border: 2px solid #667eea;
        border-radius: 25px;
        transition: all 0.3s ease;
        margin: 24px 0;
        position: relative;
        overflow: hidden;
    }

    .forgot-password-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 0;
        height: 100%;
        background: #667eea;
        transition: width 0.3s ease;
        z-index: -1;
    }

    .forgot-password-link:hover::before {
        width: 100%;
    }

    .forgot-password-link:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }

    .divider {
        position: relative;
        text-align: center;
        margin: 32px 0;
    }

    .divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, #e5e7eb, transparent);
    }

    .divider span {
        background: rgba(255, 255, 255, 0.9);
        padding: 0 20px;
        color: #6b7280;
        font-weight: 500;
    }

    .create-account-link {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        position: relative;
        transition: all 0.3s ease;
    }

    .create-account-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: #667eea;
        transition: width 0.3s ease;
    }

    .create-account-link:hover::after {
        width: 100%;
    }

    .create-account-link:hover {
        color: #764ba2;
        transform: translateY(-1px);
    }

    .error-message {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.2);
        color: #dc2626;
        padding: 12px 16px;
        border-radius: 12px;
        font-size: 14px;
        margin-top: 8px;
        animation: shake 0.5s ease-in-out;
    }

    @keyframes shake {

        0%,
        100% {
            transform: translateX(0);
        }

        25% {
            transform: translateX(-5px);
        }

        75% {
            transform: translateX(5px);
        }
    }

    .is-invalid {
        border-color: #ef4444 !important;
        animation: shake 0.5s ease-in-out;
    }

    @media (max-width: 768px) {
        .login-card {
            padding: 30px 25px;
            margin: 10px;
        }

        .login-title {
            font-size: 1.8rem;
        }
    }
</style>

<div class="login-container">
    <div class="login-card">
        @include('layouts.message')

        <div class="login-header">
            <h1 class="login-title">Welcome Back</h1>
            <p class="login-subtitle">Sign in to continue to your account</p>
        </div>

        <form method="POST" action="{{ route('account.authenticate') }}">
            @csrf

            <div class="form-floating">
                <input type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror"
                    name="email" id="email" placeholder="name@example.com" required>
                <label for="email">Email Address</label>
                @error('email')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    id="password" placeholder="Password" required>
                <label for="password">Password</label>
                @error('password')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="login-btn">
                Sign In
            </button>
        </form>

        <div style="text-align: center;">
            <a href="{{ route('password.request') }}" class="forgot-password-link">
                Forgot Password?
            </a>
        </div>

        <div class="divider">
            <span>or</span>
        </div>

        <div style="text-align: center;">
            <a href="{{ route('account.register') }}" class="create-account-link">
                Create New Account
            </a>
        </div>
    </div>
</div>
@endsection