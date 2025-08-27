@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-9">
            @include('layouts.message')
            <div class="card border-0 shadow">
                <div class="card-header  text-white">
                    Edit Review
                </div>
                <div class="card-body pb-0">
                    <form action="{{ route('account.reviews.updateReview', $review->review_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Review</label>
                            <textarea class="form-control @error('review') is-invalid @enderror" name="review"
                                id="review">{{old('review',$review->review)}}</textarea>
                            @error('review')
                            <p class="invalid-feedback">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="rating">Rating</label>
                            <select name="rating" class="form-control @error('rating') is-invalid @enderror">
                                @for($i = 1; $i <= 5; $i++) <option value="{{ $i }}" {{ $review->rating == $i ?
                                    'selected' : '' }}>
                                    {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                                    </option>
                                    @endfor
                            </select>
                            @error('rating')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="book_id" class="form-label">Select Book</label>
                            <select name="book_id" class="form-control @error('book_id') is-invalid @enderror">
                                <option value="">-- Keep current book --</option>
                                @foreach($books as $book)
                                <option value="{{ $book->book_id }}" {{ $review->book_id == $book->book_id ? 'selected'
                                    : '' }}>
                                    {{ $book->title }}
                                </option>
                                @endforeach
                            </select>

                            @error('book_id')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <button class="btn btn-primary" style="margin-bottom: 5px">Update</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection