@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper"
    style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); min-height: 100vh; padding: 20px 0;">
    <div class="row" style="margin: 3rem 0; display: flex; justify-content: center;">
        <div class="col-md-10" style="max-width: 900px;">
            @include('layouts.message')

            <div class="card"
                style="border: none; box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15); border-radius: 15px; background: white; overflow: hidden;">
                <div class="card-header"
                    style="background: linear-gradient(135deg, #6f42c1 0%, #e83e8c 100%); color: white; padding: 20px 25px; font-size: 24px; font-weight: 700; text-align: center; border: none; position: relative;">
                    <div style="display: inline-flex; align-items: center; gap: 10px;">
                        📚 Add New Book
                    </div>

                </div>
                <div class="card-body"
                    style="padding: 30px 25px; background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);">
                    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row" style="margin-bottom: 20px;">
                            <div class="col-md-6" style="padding-right: 15px; margin-bottom: 20px;">
                                <label for="title" class="form-label"
                                    style="font-weight: 600; color: #495057; margin-bottom: 8px; display: block; font-size: 14px;">
                                    📖 Title <span style="color: #e74c3c;">*</span>
                                </label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" id="title" placeholder="Enter book title" value="{{old('title')}}"
                                    style="border: 2px solid #e9ecef; border-radius: 8px; padding: 12px 15px; font-size: 14px; transition: all 0.3s ease; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.05);"
                                    onfocus="this.style.borderColor='#6f42c1'; this.style.boxShadow='0 0 0 0.2rem rgba(111, 66, 193, 0.25)'; this.style.transform='translateY(-1px)';"
                                    onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.05)'; this.style.transform='translateY(0)';">
                                @error('title') <p class="invalid-feedback"
                                    style="color: #e74c3c; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6" style="padding-left: 15px; margin-bottom: 20px;">
                                <label for="author" class="form-label"
                                    style="font-weight: 600; color: #495057; margin-bottom: 8px; display: block; font-size: 14px;">
                                    ✍️ Author <span style="color: #e74c3c;">*</span>
                                </label>
                                <input type="text" class="form-control @error('author') is-invalid @enderror"
                                    name="author" id="author" placeholder="Enter author name" value="{{old('author')}}"
                                    style="border: 2px solid #e9ecef; border-radius: 8px; padding: 12px 15px; font-size: 14px; transition: all 0.3s ease; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.05);"
                                    onfocus="this.style.borderColor='#6f42c1'; this.style.boxShadow='0 0 0 0.2rem rgba(111, 66, 193, 0.25)'; this.style.transform='translateY(-1px)';"
                                    onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.05)'; this.style.transform='translateY(0)';">
                                @error('author') <p class="invalid-feedback"
                                    style="color: #e74c3c; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 20px;">
                            <div class="col-md-6" style="padding-right: 15px; margin-bottom: 20px;">
                                <label for="description" class="form-label"
                                    style="font-weight: 600; color: #495057; margin-bottom: 8px; display: block; font-size: 14px;">
                                    📝 Description
                                </label>
                                <textarea name="description" id="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Enter book description..." rows="4"
                                    style="border: 2px solid #e9ecef; border-radius: 8px; padding: 12px 15px; font-size: 14px; transition: all 0.3s ease; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.05); resize: vertical; min-height: 100px;"
                                    onfocus="this.style.borderColor='#6f42c1'; this.style.boxShadow='0 0 0 0.2rem rgba(111, 66, 193, 0.25)'; this.style.transform='translateY(-1px)';"
                                    onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.05)'; this.style.transform='translateY(0)';">{{old('description')}}</textarea>
                                @error('description') <p class="invalid-feedback"
                                    style="color: #e74c3c; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6" style="padding-left: 15px; margin-bottom: 20px;">
                                <label for="cover_img" class="form-label"
                                    style="font-weight: 600; color: #495057; margin-bottom: 8px; display: block; font-size: 14px;">
                                    🖼️ Cover Image
                                </label>
                                <div style="position: relative;">
                                    <input type="file" class="form-control @error('cover_img') is-invalid @enderror"
                                        name="cover_img" id="cover_img" value="{{old('cover_img')}}" accept="image/*"
                                        style="border: 2px dashed #e9ecef; border-radius: 8px; padding: 12px 15px; font-size: 14px; transition: all 0.3s ease; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.05);"
                                        onfocus="this.style.borderColor='#6f42c1'; this.style.boxShadow='0 0 0 0.2rem rgba(111, 66, 193, 0.25)';"
                                        onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.05)';"
                                        onchange="this.style.borderColor='#28a745'; this.style.borderStyle='solid';">
                                    <small
                                        style="color: #6c757d; font-size: 11px; margin-top: 5px; display: block;">Accepted
                                        formats: JPG, PNG, GIF (Max: 2MB)</small>
                                </div>
                                @error('cover_img') <p class="invalid-feedback"
                                    style="color: #e74c3c; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 20px;">
                            <div class="col-md-4" style="padding-right: 10px; margin-bottom: 20px;">
                                <label for="publisher_year" class="form-label"
                                    style="font-weight: 600; color: #495057; margin-bottom: 8px; display: block; font-size: 14px;">
                                    📅 Publisher Year
                                </label>
                                <input type="number" class="form-control @error('publisher_year') is-invalid @enderror"
                                    name="publisher_year" id="publisher_year" placeholder="e.g. 2020" min="1800"
                                    max="2030" value="{{ old('publisher_year') }}"
                                    style="border: 2px solid #e9ecef; border-radius: 8px; padding: 12px 15px; font-size: 14px; transition: all 0.3s ease; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.05);"
                                    onfocus="this.style.borderColor='#6f42c1'; this.style.boxShadow='0 0 0 0.2rem rgba(111, 66, 193, 0.25)'; this.style.transform='translateY(-1px)';"
                                    onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.05)'; this.style.transform='translateY(0)';">
                                @error('publisher_year') <p class="invalid-feedback"
                                    style="color: #e74c3c; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-4" style="padding: 0 10px; margin-bottom: 20px;">
                                <label for="publisher" class="form-label"
                                    style="font-weight: 600; color: #495057; margin-bottom: 8px; display: block; font-size: 14px;">
                                    🏢 Publisher
                                </label>
                                <input type="text" class="form-control @error('publisher') is-invalid @enderror"
                                    name="publisher" id="publisher" placeholder="Publisher name"
                                    value="{{ old('publisher') }}"
                                    style="border: 2px solid #e9ecef; border-radius: 8px; padding: 12px 15px; font-size: 14px; transition: all 0.3s ease; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.05);"
                                    onfocus="this.style.borderColor='#6f42c1'; this.style.boxShadow='0 0 0 0.2rem rgba(111, 66, 193, 0.25)'; this.style.transform='translateY(-1px)';"
                                    onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.05)'; this.style.transform='translateY(0)';">
                                @error('publisher') <p class="invalid-feedback"
                                    style="color: #e74c3c; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-4" style="padding-left: 10px; margin-bottom: 20px;">
                                <label for="genre" class="form-label"
                                    style="font-weight: 600; color: #495057; margin-bottom: 8px; display: block; font-size: 14px;">
                                    🏷️ Select Genre <span style="color: #e74c3c;">*</span>
                                </label>
                                <select name="genre_id" id="genre"
                                    class="form-control @error('genre_id') is-invalid @enderror"
                                    style="border: 2px solid #e9ecef; border-radius: 8px; padding: 12px 15px; font-size: 14px; transition: all 0.3s ease; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.05); cursor: pointer;"
                                    onfocus="this.style.borderColor='#6f42c1'; this.style.boxShadow='0 0 0 0.2rem rgba(111, 66, 193, 0.25)'; this.style.transform='translateY(-1px)';"
                                    onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.05)'; this.style.transform='translateY(0)';">
                                    <option value="" style="color: #6c757d;">-- Select Genre --</option>
                                    @foreach($genres as $genre)
                                    <option value="{{ $genre->genre_id }}" {{ old('genre_id')==$genre->genre_id ?
                                        'selected' : '' }}>
                                        {{ $genre->genre_name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('genre_id') <p class="invalid-feedback"
                                    style="color: #e74c3c; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 30px;">
                            <div class="col-md-6" style="padding-right: 15px; margin-bottom: 20px;">
                                <label for="page_count" class="form-label"
                                    style="font-weight: 600; color: #495057; margin-bottom: 8px; display: block; font-size: 14px;">
                                    📄 Page Count
                                </label>
                                <input type="number" class="form-control @error('page_count') is-invalid @enderror"
                                    name="page_count" id="page_count" placeholder="e.g. 300" min="1"
                                    value="{{old('page_count')}}"
                                    style="border: 2px solid #e9ecef; border-radius: 8px; padding: 12px 15px; font-size: 14px; transition: all 0.3s ease; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.05);"
                                    onfocus="this.style.borderColor='#6f42c1'; this.style.boxShadow='0 0 0 0.2rem rgba(111, 66, 193, 0.25)'; this.style.transform='translateY(-1px)';"
                                    onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.05)'; this.style.transform='translateY(0)';">
                                @error('page_count') <p class="invalid-feedback"
                                    style="color: #e74c3c; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6" style="padding-left: 15px; margin-bottom: 20px;">
                                <label for="language" class="form-label"
                                    style="font-weight: 600; color: #495057; margin-bottom: 8px; display: block; font-size: 14px;">
                                    🌐 Language
                                </label>
                                <input type="text" class="form-control @error('language') is-invalid @enderror"
                                    name="language" id="language" placeholder="e.g. English, Urdu"
                                    value="{{old('language')}}"
                                    style="border: 2px solid #e9ecef; border-radius: 8px; padding: 12px 15px; font-size: 14px; transition: all 0.3s ease; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.05);"
                                    onfocus="this.style.borderColor='#6f42c1'; this.style.boxShadow='0 0 0 0.2rem rgba(111, 66, 193, 0.25)'; this.style.transform='translateY(-1px)';"
                                    onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.05)'; this.style.transform='translateY(0)';">
                                @error('language') <p class="invalid-feedback"
                                    style="color: #e74c3c; font-size: 12px; margin-top: 5px;">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div style="text-align: center; padding-top: 20px; border-top: 2px solid #f8f9fa;">
                            <button type="submit" class="btn btn-primary"
                                style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border: none; padding: 15px 40px; border-radius: 25px; font-weight: 600; font-size: 16px; color: white; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3); text-transform: uppercase; letter-spacing: 1px;"
                                onmouseover="this.style.transform='translateY(-2px) scale(1.05)'; this.style.boxShadow='0 8px 25px rgba(40, 167, 69, 0.4)'; this.style.background='linear-gradient(135deg, #20c997 0%, #17a2b8 100%)';"
                                onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 4px 15px rgba(40, 167, 69, 0.3)'; this.style.background='linear-gradient(135deg, #28a745 0%, #20c997 100%)';"
                                onclick="showLoader(this)">
                                ✨ Create Book
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


{{-- @section('java_script')
<script>
    // Loader function with CSS animation
    function showLoader(button) {
        const style = document.createElement('style');
        style.textContent = `
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        `;
        document.head.appendChild(style);
        
        button.innerHTML = '<span style="display: inline-flex; align-items: center; gap: 8px;"><div style="width: 16px; height: 16px; border: 2px solid white; border-top: 2px solid transparent; border-radius: 50%; animation: spin 1s linear infinite;"></div>Creating...</span>';
        button.disabled = true;
    }

    // Form validation enhancement
    document.querySelector('form').addEventListener('submit', function(e) {
        const requiredFields = ['title', 'author', 'genre_id'];
        let hasError = false;
        
        requiredFields.forEach(field => {
            const input = document.getElementById(field === 'genre_id' ? 'genre' : field);
            if (!input.value.trim()) {
                input.style.borderColor = '#e74c3c';
                input.style.boxShadow = '0 0 0 0.2rem rgba(231, 76, 60, 0.25)';
                hasError = true;
                
                // Add shake animation
                input.style.animation = 'shake 0.5s ease-in-out';
                setTimeout(() => {
                    input.style.animation = '';
                }, 500);
            }
        });
        
        if (hasError) {
            e.preventDefault();
            
            // Show error message
            let errorDiv = document.getElementById('validation-error');
            if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.id = 'validation-error';
                errorDiv.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
                    color: white;
                    padding: 15px 20px;
                    border-radius: 8px;
                    box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
                    z-index: 9999;
                    font-weight: 600;
                    opacity: 0;
                    transform: translateX(300px);
                    transition: all 0.3s ease;
                `;
                document.body.appendChild(errorDiv);
            }
            
            errorDiv.innerHTML = '⚠️ Please fill in all required fields!';
            
            // Show notification
            setTimeout(() => {
                errorDiv.style.opacity = '1';
                errorDiv.style.transform = 'translateX(0)';
            }, 10);
            
            // Hide notification after 3 seconds
            setTimeout(() => {
                errorDiv.style.opacity = '0';
                errorDiv.style.transform = 'translateX(300px)';
                setTimeout(() => {
                    if (errorDiv.parentNode) {
                        errorDiv.parentNode.removeChild(errorDiv);
                    }
                }, 300);
            }, 3000);
            
            // Reset button
            const button = this.querySelector('button[type="submit"]');
            button.innerHTML = '✨ Create Book';
            button.disabled = false;
        }
    });

    // Real-time validation with visual feedback
    document.querySelectorAll('input, select, textarea').forEach(input => {
        input.addEventListener('input', function() {
            if (this.value.trim()) {
                this.style.borderColor = '#28a745';
                this.style.boxShadow = '0 0 0 0.2rem rgba(40, 167, 69, 0.25)';
                
                // Add success checkmark
                let checkmark = this.parentNode.querySelector('.success-checkmark');
                if (!checkmark) {
                    checkmark = document.createElement('div');
                    checkmark.className = 'success-checkmark';
                    checkmark.innerHTML = '✓';
                    checkmark.style.cssText = `
                        position: absolute;
                        right: 10px;
                        top: 50%;
                        transform: translateY(-50%);
                        color: #28a745;
                        font-weight: bold;
                        font-size: 16px;
                        opacity: 0;
                        transition: opacity 0.3s ease;
                    `;
                    this.parentNode.style.position = 'relative';
                    this.parentNode.appendChild(checkmark);
                }
                checkmark.style.opacity = '1';
            } else {
                // Remove checkmark if field is empty
                let checkmark = this.parentNode.querySelector('.success-checkmark');
                if (checkmark) {
                    checkmark.style.opacity = '0';
                }
                this.style.borderColor = '#e9ecef';
                this.style.boxShadow = '0 2px 4px rgba(0,0,0,0.05)';
            }
        });
        
        // Remove error styling on focus
        input.addEventListener('focus', function() {
            if (this.style.borderColor === 'rgb(231, 76, 60)') {
                this.style.borderColor = '#6f42c1';
                this.style.boxShadow = '0 0 0 0.2rem rgba(111, 66, 193, 0.25)';
            }
        });
    });

    // File upload preview with visual feedback
    document.getElementById('cover_img').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Show file info
            let fileInfo = this.parentNode.querySelector('.file-info');
            if (!fileInfo) {
                fileInfo = document.createElement('div');
                fileInfo.className = 'file-info';
                fileInfo.style.cssText = `
                    margin-top: 8px;
                    padding: 8px 12px;
                    background: linear-gradient(135deg, #e8f5e8 0%, #f0f8f0 100%);
                    border-radius: 6px;
                    font-size: 12px;
                    color: #155724;
                    border: 1px solid #c3e6cb;
                `;
                this.parentNode.appendChild(fileInfo);
            }
            
            fileInfo.innerHTML = `
                📁 <strong>${file.name}</strong><br>
                📏 Size: ${(file.size / 1024 / 1024).toFixed(2)} MB<br>
                📋 Type: ${file.type}
            `;
            
            // Add animation
            fileInfo.style.opacity = '0';
            fileInfo.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                fileInfo.style.transition = 'all 0.3s ease';
                fileInfo.style.opacity = '1';
                fileInfo.style.transform = 'translateY(0)';
            }, 10);
        }
    });

    // Add shake animation dynamically
    const shakeStyle = document.createElement('style');
    shakeStyle.textContent = `
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
    `;
    document.head.appendChild(shakeStyle);
</script>
@endsection --}}