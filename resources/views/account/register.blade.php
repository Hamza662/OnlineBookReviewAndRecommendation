@extends('layouts.app')

@section('main')
<style>
    .register-container {
        min-height: 100vh;
        /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        position: relative;
        overflow: hidden;
    }

    .register-container::before {
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

    .register-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 24px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        padding: 40px;
        width: 100%;
        max-width: 500px;
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

    .register-header {
        text-align: center;
        margin-bottom: 35px;
    }

    .register-title {
        font-size: 2.2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }

    .register-subtitle {
        color: #6b7280;
        font-size: 1rem;
        font-weight: 400;
    }

    .form-floating {
        position: relative;
        margin-bottom: 20px;
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

    .register-btn {
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
        margin-top: 20px;
    }

    .register-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .register-btn:hover::before {
        left: 100%;
    }

    .register-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }

    .register-btn:active {
        transform: translateY(0);
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

    .login-link {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        position: relative;
        transition: all 0.3s ease;
    }

    .login-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: #667eea;
        transition: width 0.3s ease;
    }

    .login-link:hover::after {
        width: 100%;
    }

    .login-link:hover {
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

    .password-strength {
        margin-top: 8px;
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .strength-weak {
        background: rgba(239, 68, 68, 0.1);
        color: #dc2626;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .strength-medium {
        background: rgba(245, 158, 11, 0.1);
        color: #d97706;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .strength-strong {
        background: rgba(34, 197, 94, 0.1);
        color: #16a34a;
        border: 1px solid rgba(34, 197, 94, 0.2);
    }

    .form-group {
        animation: fadeInUp 0.5s ease-out forwards;
        opacity: 0;
        transform: translateY(20px);
    }

    .form-group:nth-child(1) {
        animation-delay: 0.1s;
    }

    .form-group:nth-child(2) {
        animation-delay: 0.2s;
    }

    .form-group:nth-child(3) {
        animation-delay: 0.3s;
    }

    .form-group:nth-child(4) {
        animation-delay: 0.4s;
    }

    .form-group:nth-child(5) {
        animation-delay: 0.5s;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .register-card {
            padding: 30px 25px;
            margin: 10px;
        }

        .register-title {
            font-size: 1.8rem;
        }
    }
</style>

<div class="register-container">
    <div class="register-card">
        <div class="register-header">
            <h1 class="register-title">Create Account</h1>
            <p class="register-subtitle">Join us today and get started</p>
        </div>

        <form action="{{ route('account.processRegister') }}" method="POST" id="registerForm">
            @csrf

            <div class="form-group">
                <div class="form-floating">
                    <input type="text" value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                        placeholder="Full Name">
                    <label for="name">Full Name</label>
                    @error('name')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="form-floating">
                    <input type="email" value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                        placeholder="name@example.com">
                    <label for="email">Email Address</label>
                    @error('email')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="form-floating">
                    <input type="name" value="{{ old('bio') }}" class="form-control @error('bio') is-invalid @enderror"
                        name="bio" id="bio" placeholder="something about you.">
                    <label for="bio">Bio</label>
                    @error('bio')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <div class="form-floating" style="position: relative;">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        id="password" placeholder="Password" style="padding-right: 45px;">
                    <label for="password">Password</label>
                    <button type="button" class="password-toggle-btn" data-target="password"
                        style="position: absolute; right: 12px; top: 20px; background: none; border: none; color: #6c757d; cursor: pointer; z-index: 10; padding: 8px; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;"
                        onmouseover="this.style.color='#495057'" onmouseout="this.style.color='#6c757d'"
                        onfocus="this.style.outline='none'; this.style.color='#495057'">
                        <i class="fas fa-eye" id="password-toggle-icon"></i>
                    </button>
                    <div id="passwordStrength"
                        style="display: none; margin-top: 8px; font-size: 12px; font-weight: 500;"></div>
                    @error('password')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <div class="form-floating" style="position: relative;">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation" id="password_confirmation" placeholder="Confirm Password"
                        style="padding-right: 45px;">
                    <label for="password_confirmation">Confirm Password</label>
                    <button type="button" class="password-toggle-btn" data-target="password_confirmation"
                        style="position: absolute; right: 12px; top: 20px; background: none; border: none; color: #6c757d; cursor: pointer; z-index: 10; padding: 8px; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;"
                        onmouseover="this.style.color='#495057'" onmouseout="this.style.color='#6c757d'"
                        onfocus="this.style.outline='none'; this.style.color='#495057'">
                        <i class="fas fa-eye" id="password_confirmation-toggle-icon"></i>
                    </button>
                    <div id="passwordMatch" style="display: none; margin-top: 8px; font-size: 12px; font-weight: 500;">
                    </div>
                    @error('password_confirmation')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="register-btn">
                    Create Account
                </button>
            </div>
        </form>

        <div class="divider">
            <span>Already have an account?</span>
        </div>

        <div style="text-align: center;">
            <a href="{{ route('account.login') }}" class="login-link">
                Sign In Here
            </a>
        </div>
    </div>
</div>

<script>
    // Define togglePassword function globally
function togglePassword(fieldId) {
    const passwordField = document.getElementById(fieldId);
    const toggleIcon = document.getElementById(fieldId + '-toggle-icon');
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');
    const passwordStrength = document.getElementById('passwordStrength');
    const passwordMatch = document.getElementById('passwordMatch');
    
    // Add event listeners to password toggle buttons
    document.querySelectorAll('.password-toggle-btn').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            togglePassword(targetId);
        });
    });
    
    // Password strength checker
    passwordInput.addEventListener('input', function() {
        const password = this.value;
        const strength = checkPasswordStrength(password);
        
        if (password.length > 0) {
            passwordStrength.style.display = 'block';
            passwordStrength.textContent = strength.text;
            passwordStrength.className = 'password-strength ' + strength.class;
        } else {
            passwordStrength.style.display = 'none';
        }
    });
    
    // Password confirmation checker
    confirmPasswordInput.addEventListener('input', function() {
        const password = passwordInput.value;
        const confirmPassword = this.value;
        
        if (confirmPassword.length > 0) {
            passwordMatch.style.display = 'block';
            if (password === confirmPassword) {
                passwordMatch.textContent = '✓ Passwords match';
                passwordMatch.style.color = '#16a34a';
            } else {
                passwordMatch.textContent = '✗ Passwords do not match';
                passwordMatch.style.color = '#dc2626';
            }
        } else {
            passwordMatch.style.display = 'none';
        }
    });
    
    function checkPasswordStrength(password) {
        let score = 0;
        
        if (password.length >= 8) score++;
        if (/[a-z]/.test(password)) score++;
        if (/[A-Z]/.test(password)) score++;
        if (/[0-9]/.test(password)) score++;
        if (/[^A-Za-z0-9]/.test(password)) score++;
        
        if (score < 3) {
            return { text: 'Weak password', class: 'strength-weak' };
        } else if (score < 4) {
            return { text: 'Medium strength', class: 'strength-medium' };
        } else {
            return { text: 'Strong password', class: 'strength-strong' };
        }
    }
});
</script>
@endsection