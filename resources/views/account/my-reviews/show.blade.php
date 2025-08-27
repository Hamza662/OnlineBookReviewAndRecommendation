@extends('layouts.app')

@section('main')
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Your Review on "{{ $review->book->title }}"</h4>
            <p class="card-text">{{ $review->content }}</p>
            <p><strong>Rating:</strong> {{ $review->rating }}/5</p>
            <p><small class="text-muted">Reviewed on {{ $review->created_at->format('d M Y') }}</small></p>
        </div>
    </div>

    <hr>

    <h5>Replies to Your Review:</h5>

    @forelse($review->replies as $reply)
    <div class="card mb-2">
        <div class="card-body">
            <p>{{ $reply->message }}</p>
            <p class="text-muted mb-0">
                <small>By {{ $reply->user->name }} on {{ $reply->created_at->format('d M Y, h:i A') }}</small>
            </p>
        </div>
    </div>
    @empty
    <p>No replies yet.</p>
    @endforelse

    <a href="{{ route('account.myReviews') }}" class="btn btn-secondary mt-3">Back to My Reviews</a>
</div>
@endsection