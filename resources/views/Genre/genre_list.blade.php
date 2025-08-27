@extends('layouts.app')
@section('main')
<form action="{{ route('genres.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="genre_name" class="form-label">Genre Name</label>
        <input type="text" name="genre_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Add Genre</button>
</form>
@endsection
