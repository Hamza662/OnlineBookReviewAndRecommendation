@extends('layouts.app')

@section('main')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2>{{ $wishlist->name }}</h2>
                    <p class="text-muted mb-0">
                        {{ $wishlist->wishlistItems->count() }} books •
                        Created {{ $wishlist->creation_date->format('M d, Y') }}
                        @if($wishlist->is_public)
                        • <span class="badge bg-success">Public</span>
                        @endif
                    </p>
                </div>
                <div>
                    <a href="{{ route('account.wishlists.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Wishlists
                    </a>
                </div>
            </div>

            @if($wishlist->wishlistItems->count() > 0)
            <div class="row">
                @foreach($wishlist->wishlistItems as $item)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        @if($item->book->cover_img)
                        <img src="{{asset('uploads/books/thumb/'.$item->book->cover_img)}}" class="card-img-top"
                            alt="{{ $item->book->title }}" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h6 class="card-title">{{ $item->book->title }}</h6>
                            <p class="card-text">
                                <small class="text-muted">by {{ $item->book->author }}</small><br>
                                {{-- <strong class="text-primary">${{ $item->book->price }}</strong> --}}
                            </p>
                            <p class="card-text">
                                <small class="text-muted">Added: {{ $item->date_added->format('M d, Y') }}</small>
                            </p>
                        </div>
                        <div class="card-footer">
                            <div class="btn-group w-100" role="group">
                                <a href="{{ route('book.detail', $item->book->book_id) }}"
                                    class="btn btn-outline-primary btn-sm">View Book</a>
                                <button class="btn btn-outline-danger btn-sm remove-book-btn"
                                    data-wishlist-id="{{ $wishlist->wish_list_id }}"
                                    data-book-id="{{ $item->book->book_id }}">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-book fa-3x text-muted mb-3"></i>
                <h4>No Books in This Wishlist</h4>
                <p class="text-muted">Start browsing and add books to this wishlist!</p>
                <a href="{{ route('admin.books.index') }}" class="btn btn-primary">Browse Books</a>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    document.querySelectorAll('.remove-book-btn').forEach(btn => {
 btn.addEventListener('click', function () {
    if (confirm('Remove this book from wishlist?')) {
      const wishlistId = this.dataset.wishlistId;
      const bookId = this.dataset.bookId;

      fetch('{{ route("account.wishlist.items.remove") }}', {
        method: 'POST',
        body: JSON.stringify({
          wish_list_id: wishlistId,
          book_id: bookId
        }),
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        // ✅ Just reload the page without trying to parse JSON
        location.reload();
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Something went wrong!');
      });
    }
  });
});
</script>
@endsection