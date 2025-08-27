@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper" style="background-color: #f8f9fa; min-height: 100vh; padding: 30px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                @include('admin.layouts.message')
                
                <!-- Profile Header Card -->
                <div class="card border-0 shadow-lg mb-4" style="border-radius: 20px; overflow: hidden;">
                    <div class="card-header text-center text-white position-relative" style="background: linear-gradient(45deg, #667eea, #764ba2); padding: 40px 20px; border: none;">
                        <div>
                            <div class="mb-3">
                                <img src="{{ asset('uploads/profile/thumb/' . ($user->img ?? 'no_image.jpg')) }}" 
                                     class="rounded-circle border border-white shadow-lg" 
                                     style="width: 120px; height: 120px; object-fit: cover; border-width: 4px !important;"
                                     alt="{{ $user->name }}">
                            </div>
                            <h3 class="mb-1 fw-bold">Admin Profile</h3>
                            <p class="mb-0 opacity-75">{{ $user->name }}</p>
                        </div>
                    </div>
                </div>

                <!-- Profile Form Card -->
                <div class="card border-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
                    <div class="card-body p-5">
                        <form action="{{route('admin.admin.update.profile')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <!-- Name Field -->
                            <div class="mb-4">
                                <label for="name" class="form-label fw-semibold text-dark mb-2" style="font-size: 16px;">
                                    <i class="ti-user me-2 text-primary"></i>Full Name
                                </label>
                                <input type="text" 
                                       value="{{old('name' ,$user->name)}}"
                                       class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                       placeholder="Enter your full name" 
                                       name="name"
                                       style="border-radius: 12px; border: 2px solid #e3e6f0; padding: 15px 20px; font-size: 16px; transition: all 0.3s ease;"
                                       onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 0 0.2rem rgba(102, 126, 234, 0.25)'"
                                       onblur="this.style.borderColor='#e3e6f0'; this.style.boxShadow='none'" />
                                @error('name')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="ti-alert-circle me-1"></i>{{$message}}
                                </div>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold text-dark mb-2" style="font-size: 16px;">
                                    <i class="ti-email me-2 text-primary"></i>Email Address
                                </label>
                                <input type="email" 
                                       value="{{old('email' ,$user->email)}}"
                                       class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                       placeholder="Enter your email address" 
                                       name="email"
                                       id="email"
                                       style="border-radius: 12px; border: 2px solid #e3e6f0; padding: 15px 20px; font-size: 16px; transition: all 0.3s ease;"
                                       onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 0 0.2rem rgba(102, 126, 234, 0.25)'"
                                       onblur="this.style.borderColor='#e3e6f0'; this.style.boxShadow='none'" />
                                @error('email')
                                <div class="invalid-feedback d-flex align-items-center">
                                    <i class="ti-alert-circle me-1"></i>{{$message}}
                                </div>
                                @enderror
                            </div>

                            <!-- Image Upload Field -->
                            <div class="mb-4">
                                <label for="img" class="form-label fw-semibold text-dark mb-2" style="font-size: 16px;">
                                    <i class="ti-camera me-2 text-primary"></i>Profile Picture
                                </label>
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <input type="file" 
                                               name="img" 
                                               id="img" 
                                               class="form-control form-control-lg @error('img') is-invalid @enderror"
                                               accept="image/*"
                                               style="border-radius: 12px; border: 2px solid #e3e6f0; padding: 15px 20px; font-size: 16px; transition: all 0.3s ease;"
                                               onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 0 0.2rem rgba(102, 126, 234, 0.25)'"
                                               onblur="this.style.borderColor='#e3e6f0'; this.style.boxShadow='none'">
                                        @error('img')
                                        <div class="invalid-feedback d-flex align-items-center">
                                            <i class="ti-alert-circle me-1"></i>{{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <div class="position-relative d-inline-block">
                                            <img src="{{ asset('uploads/profile/thumb/' . ($user->img ?? 'no_image.jpg')) }}" 
                                                 class="rounded-circle shadow-sm border border-light" 
                                                 style="width: 80px; height: 80px; object-fit: cover; border-width: 3px !important;"
                                                 alt="{{ $user->name }}">
                                            <div class="position-absolute bottom-0 end-0 bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 25px; height: 25px;">
                                                <i class="ti-camera text-white" style="font-size: 12px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted mt-2 d-block">
                                    <i class="ti-info-alt me-1"></i>Choose a clear photo that represents you well. Max size: 2MB
                                </small>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center pt-3">
                                <button type="submit" 
                                        class="btn btn-lg px-5 py-3 fw-semibold text-white border-0 shadow-lg" 
                                        style="background: linear-gradient(45deg, #667eea, #764ba2); border-radius: 50px; font-size: 16px; transition: all 0.3s ease; transform: translateY(0px);"
                                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 25px rgba(102, 126, 234, 0.4)'"
                                        onmouseout="this.style.transform='translateY(0px)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.2)'">
                                    <i class="ti-check me-2"></i>Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Additional Info Card -->
                <div class="card border-0 shadow-sm mt-4" style="border-radius: 15px; background: rgba(255, 255, 255, 0.95);">
                    <div class="card-body p-4 text-center">
                        <div class="row">
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="ti-shield text-primary" style="font-size: 20px;"></i>
                                    </div>
                                    <div class="text-start">
                                        <h6 class="mb-0 fw-semibold">Secure</h6>
                                        <small class="text-muted">Data Protected</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="ti-cloud-up text-success" style="font-size: 20px;"></i>
                                    </div>
                                    <div class="text-start">
                                        <h6 class="mb-0 fw-semibold">Auto Save</h6>
                                        <small class="text-muted">Instant Backup</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
                                        <i class="ti-settings text-info" style="font-size: 20px;"></i>
                                    </div>
                                    <div class="text-start">
                                        <h6 class="mb-0 fw-semibold">Customizable</h6>
                                        <small class="text-muted">Your Preferences</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb {
        background: linear-gradient(45deg, #667eea, #764ba2);
        border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(45deg, #5a67d8, #6b46c1);
    }
    
    /* Form animations */
    .form-control:focus {
        animation: inputFocus 0.3s ease;
    }
    
    @keyframes inputFocus {
        0% { transform: scale(1); }
        50% { transform: scale(1.02); }
        100% { transform: scale(1); }
    }
    
    /* Button hover effects */
    .btn:hover {
        animation: buttonHover 0.3s ease;
    }
    
    @keyframes buttonHover {
        0% { transform: translateY(0px); }
        100% { transform: translateY(-2px); }
    }
    
    /* Card hover effects */
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
    }
</style>
@endsection