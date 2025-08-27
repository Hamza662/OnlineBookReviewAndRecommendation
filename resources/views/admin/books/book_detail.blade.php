@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid py-4">
        <!-- Back Button with Modern Design -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="{{route('admin.books.index')}}"
                    class="btn btn-outline-primary btn-sm d-inline-flex align-items-center gap-2 rounded-pill shadow-sm">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Books</span>
                </a>
            </div>
        </div>

        <!-- Main Book Details Card -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <!-- Book Cover Section -->
                            <div class="col-lg-4 col-md-5">
                                <div
                                    class="position-relative h-100 bg-gradient-primary d-flex align-items-center justify-content-center p-4">
                                    <div class="book-cover-container">
                                        @if($book->cover_img != '')
                                        <img src="{{asset('uploads/books/thumb/'.$book->cover_img)}}"
                                            alt="{{$book->title}}" class="img-fluid rounded-3 shadow-lg book-cover">
                                        @else
                                        <img src="{{asset('images/no_image.jpg')}}" alt="No Cover Available"
                                            class="img-fluid rounded-3 shadow-lg book-cover">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Book Information Section -->
                            <div class="col-lg-8 col-md-7">
                                <div class="p-4 p-lg-5">
                                    @include('layouts.message')

                                    <!-- Book Title -->
                                    <div class="mb-4">
                                        <span
                                            class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 mb-2">
                                            <i class="fas fa-book me-1"></i> Book Details
                                        </span>
                                        <h1 class="display-5 fw-bold text-dark mb-0">{{$book->title}}</h1>
                                    </div>

                                    <!-- Author -->
                                    <div class="mb-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div
                                                class="feature-icon bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="fas fa-user-edit"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted fw-medium">Author</small>
                                                <h5 class="mb-0 text-dark">{{$book->author}}</h5>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Publication Year -->
                                    <div class="mb-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div
                                                class="feature-icon bg-info bg-opacity-10 text-info rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted fw-medium">Publication Year</small>
                                                <h5 class="mb-0 text-dark">{{$book->publisher_year}}</h5>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Rating Section -->
                                    @php
                                    if($book->reviews_count > 0){
                                    $avgRating = $book->reviews_sum_rating / $book->reviews_count;
                                    } else{
                                    $avgRating = 0;
                                    }
                                    $avgRatingPer = ($avgRating*100)/5;
                                    @endphp

                                    <div class="mb-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div
                                                class="feature-icon bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted fw-medium">Rating</small>
                                                <div class="d-flex align-items-center gap-2">
                                                    <h5 class="mb-0 text-dark">{{ $avgRating }}</h5>
                                                    <div class="rating-stars"
                                                        style="position: relative; display: inline-block;">
                                                        {{-- Background (Gray) Stars --}}
                                                        <div class="stars-bg" style="color: #ccc;">
                                                            @for($i = 1; $i <= 5; $i++) <i class="far fa-star"></i>
                                                                @endfor
                                                        </div>

                                                        {{-- Foreground (Yellow) Stars Overlay --}}
                                                        <div class="stars-fill"
                                                            style="width: {{ $avgRatingPer }}%; position: absolute; top: 0; left: 0; white-space: nowrap; overflow: hidden; color: #ffc107;">
                                                            @for($i = 1; $i <= 5; $i++) <i class="fas fa-star"></i>
                                                                @endfor
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    {{-- <div class="mb-4">
                                        <h6 class="text-muted fw-bold mb-3">Description</h6>
                                        <p class="text-muted lh-lg">{{$book->description}}</p>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-transparent border-0 p-4 pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-1 fw-bold">
                                    <i class="fas fa-comments text-primary me-2"></i>
                                    Reviews
                                </h3>
                                <p class="text-muted mb-0">What others are saying about this book</p>
                            </div>
                            <button type="button"
                                class="btn btn-primary btn-lg rounded-pill shadow-sm d-flex align-items-center gap-2"
                                data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="fas fa-plus"></i>
                                <span>Add Review</span>
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        @if($book->reviews->isNotEmpty())
                        @foreach ($book->reviews as $review)
                        <div class="review-card bg-light rounded-4 p-4 mb-4 border-0 shadow-sm">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div
                                        class="user-avatar bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold">{{$review->user->name}}</h6>
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>
                                            {{\Carbon\Carbon::parse($review->created_at)->format('d M, Y')}}
                                        </small>
                                    </div>
                                </div>

                                @php
                                $ratingPer = ($review->rating/5)*100;
                                @endphp

                                <div class="star-rating-display">
                                    @for($i = 1; $i <= 5; $i++) @if($i <=$review->rating)
                                        <i class="fas fa-star text-warning"></i>
                                        @else
                                        <i class="far fa-star text-muted"></i>
                                        @endif
                                        @endfor
                                </div>
                            </div>

                            <div class="review-content">
                                <p class="mb-0 text-dark lh-lg">{{$review->review}}</p>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-comment-slash text-muted" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="text-muted mb-2">No Reviews Yet</h5>
                            <p class="text-muted">Be the first to share your thoughts about this book!</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Modal for Adding Review -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 bg-primary bg-opacity-5 rounded-top-4 p-4">
                <div>
                    <h1 class="modal-title fs-4 fw-bold mb-1" id="staticBackdropLabel">
                        <i class="fas fa-star text-warning me-2"></i>
                        Add Your Review
                    </h1>
                    <p class="text-muted mb-0 small">Share your thoughts about <strong>{{$book->title}}</strong></p>
                </div>
                <button type="button" class="btn-close rounded-circle p-2" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form action="" id="bookReviewForm" name="bookReviewForm">
                <input type="hidden" name="book_id" value="{{$book->book_id}}">
                <div class="modal-body p-4">
                    <!-- Review Text Area -->
                    <div class="mb-4">
                        <label for="review" class="form-label fw-semibold mb-2">
                            <i class="fas fa-edit text-primary me-1"></i>
                            Your Review
                        </label>
                        <textarea name="review" id="review" class="form-control rounded-3 border-2" rows="5"
                            placeholder="Write your honest review about this book..."></textarea>
                        <div class="invalid-feedback" id="review-error"></div>
                    </div>

                    <!-- Rating Selection -->
                    <div class="mb-3">
                        <label for="rating" class="form-label fw-semibold mb-3">
                            <i class="fas fa-star text-warning me-1"></i>
                            Rating
                        </label>
                        <div class="rating-selection">
                            <select name="rating" id="rating" class="form-select rounded-3 border-2">
                                <option value="5">⭐⭐⭐⭐⭐ - Excellent (5/5)</option>
                                <option value="4">⭐⭐⭐⭐☆ - Very Good (4/5)</option>
                                <option value="3">⭐⭐⭐☆☆ - Good (3/5)</option>
                                <option value="2">⭐⭐☆☆☆ - Fair (2/5)</option>
                                <option value="1">⭐☆☆☆☆ - Poor (1/5)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-paper-plane me-1"></i>
                        Submit Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .book-cover {
        max-height: 400px;
        width: auto;
        transition: transform 0.3s ease;
    }

    .book-cover:hover {
        transform: scale(1.05);
    }

    .feature-icon {
        width: 45px;
        height: 45px;
        font-size: 1.2rem;
    }

    .user-avatar {
        width: 45px;
        height: 45px;
        font-size: 1.1rem;
    }

    .stars-container {
        font-size: 1rem;
    }

    .star-rating-display .fas,
    .star-rating-display .far {
        margin-right: 2px;
    }

    .star-rating-display .fas:last-child,
    .star-rating-display .far:last-child {
        margin-right: 0;
    }

    .review-card {
        transition: all 0.3s ease;
    }

    .review-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .card {
        transition: all 0.3s ease;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    @media (max-width: 768px) {
        .display-5 {
            font-size: 2rem;
        }

        .book-cover {
            max-height: 300px;
        }

        .feature-icon,
        .user-avatar {
            width: 35px;
            height: 35px;
            font-size: 1rem;
        }
    }
</style>

@endsection

@section('script')
<script>
    $("#bookReviewForm").submit(function(e){
        e.preventDefault();
        
        // Add loading state
        const submitBtn = $(this).find('button[type="submit"]');
        const originalText = submitBtn.html();
        submitBtn.html('<i class="fas fa-spinner fa-spin me-1"></i>Submitting...').prop('disabled', true);
        
        $.ajax({
            url: '{{ route("book.saveReview") }}',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: $("#bookReviewForm").serializeArray(),
            success: function(response){
                if(response.status == false){
                    var errors = response.errors;
                    if(errors.review){
                        $("#review").addClass('is-invalid');
                        $('#review-error').html(errors.review);
                    } else {
                        $("#review").removeClass('is-invalid');
                        $('#review-error').html('');
                    }
                    
                    // Reset button
                    submitBtn.html(originalText).prop('disabled', false);
                } else {
                    // Show success message briefly before redirect
                    submitBtn.html('<i class="fas fa-check me-1"></i>Success!').removeClass('btn-primary').addClass('btn-success');
                    setTimeout(function(){
                        window.location.href = '{{route('book.detail',$book->book_id)}}';
                    }, 1000);
                }
            },
            error: function(){
                // Reset button on error
                submitBtn.html(originalText).prop('disabled', false);
                alert('Something went wrong. Please try again.');
            }
        });
    });
</script>
@endsection