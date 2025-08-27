@extends('layouts.app')
@section('main')
<div class="container my-5">
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            {{ $review->user->name }}'s Review on "{{ $review->book->title }}"
        </div>
        <div class="card-body">
            <p><strong>Rating:</strong> {{ $review->rating }}/5</p>
            <p><strong>Review:</strong><br>{{ $review->review }}</p>
        </div>
    </div>
</div>
@endsection