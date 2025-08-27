@extends('layouts.app')
@section('main')
<div class="container mt-3 pb-5">
    @include('layouts.message')
    <div class="row justify-content-center d-flex mt-5">
        <div class="col-md-12">
            <div class="d-flex justify-content-between">
                <h2 class="mb-3">Books</h2>
                <div class="mt-2">
                    <a href="{{route('home')}}" class="text-white btn btn-success">Clear</a>
                </div>
            </div>
            <div class="card shadow-lg border-0">
                <form action="" method="GET">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-11 col-md-11">
                                <input type="text" class="form-control form-control-lg"
                                    placeholder="Search by title , Author and Genre" name="keyword"
                                    value="{{Request::get('keyword')}}">
                            </div>
                            <div class="col-lg-1 col-md-1">
                                <button class="btn btn-primary btn-lg w-100"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row mt-4">
                @if($books->isNotEmpty())
                @foreach ($books as $book)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card border-0 shadow-lg h-100 d-flex flex-column" style="min-height: 400px;">
                        <div class="position-relative">
                            <a href="{{route('book.detail', $book->book_id)}}">
                                @if($book->cover_img != '')
                                <img src="{{asset('uploads/books/thumb/'.$book->cover_img)}}" alt=""
                                    class="card-img-top"
                                    style="height: 250px; object-fit: cover; transition: transform 0.3s ease;">
                                @else
                                <img src="{{asset('images/no_image.jpg')}}" alt="" class="card-img-top"
                                    style="height: 250px; object-fit: cover; transition: transform 0.3s ease;">
                                @endif
                            </a>

                            <!-- Wishlist Button - Only for logged in users who are not admin -->
                            @auth
                            @if(Auth::user()->role != 'admin')
                            <div class="position-absolute top-0 end-0 m-2">
                                @php
                                $userWishlist = Auth::user()->wishLists()->first();
                                $isInWishlist = false;
                                if($userWishlist) {
                                $isInWishlist = $userWishlist->hasBook($book->book_id);
                                }
                                @endphp

                                @if($isInWishlist)
                                <form action="{{route('account.wishlist.items.remove', $book->book_id)}}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    <input type="hidden" name="wish_list_id" value="{{ $wishlist->wish_list_id }}">
                                    <input type="hidden" name="book_id" value="{{ $book->book_id }}">
                                    <button type="submit" class="btn btn-danger btn-sm rounded-circle"
                                        title="Remove from Wishlist">
                                        <i class="fa-solid fa-heart"></i>
                                    </button>
                                </form>
                                @else
                                @if($wishlist)
                                <form action="{{route('account.wishlist.items.add', $book->book_id)}}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    <input type="hidden" name="wish_list_id" value="{{ $wishlist->wish_list_id }}">
                                    <input type="hidden" name="book_id" value="{{ $book->book_id }}">
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle"
                                        title="Add to Wishlist">
                                        <i class="fa-regular fa-heart"></i>
                                    </button>
                                </form>
                                @else
                               
                                @endif
                                @endif
                            </div>
                            @endif
                            @endauth
                        </div>

                        <div class="card-body d-flex flex-column flex-grow-1">
                            <h3 class="h5 heading mb-2"><a href="{{route('book.detail', $book->book_id)}}"
                                    class="text-decoration-none text-dark">{{$book->title}}</a></h3>
                            <p class="text-muted mb-3">by {{$book->author}}</p>
                            @php
                            if($book->reviews_count > 0){
                            $avgRating = $book->reviews_sum_rating / $book->reviews_count;
                            } else{
                            $avgRating = 0;
                            }
                            $avgRatingPer = ($avgRating*100)/5;
                            @endphp
                            <div class="mt-auto">
                                <div class="star-rating d-flex align-items-center" title="">
                                    <span
                                        class="rating-text theme-font theme-yellow me-2">{{number_format($avgRating,1)}}</span>
                                    <div class="star-rating d-inline-flex mx-2 position-relative" title="">
                                        <div class="back-stars text-muted" style="color: #ddd;">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                        <div class="front-stars position-absolute top-0 start-0 text-warning"
                                            style="width: {{$avgRatingPer}}%; overflow: hidden; color: #ffc107;">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                                <small class="theme-font text-muted mt-1 d-block">
                                    ({{($book->reviews_count > 1) ? $book->reviews_count. ' Reviews' :
                                    $book->reviews_count. ' Review' }})
                                </small>

                                <!-- Alternative Wishlist Button (if you prefer it at the bottom) -->
                                @auth
                                @if(Auth::user()->role != 'admin')
                                @php
                                $userWishlist = Auth::user()->wishLists()->first();
                                $isInWishlist = false;
                                if($userWishlist) {
                                $isInWishlist = $userWishlist->hasBook($book->book_id);
                                }
                                @endphp

                                <div class="mt-2">
                                    @if($isInWishlist)
                                    <form action="{{route('account.wishlist.items.remove', $book->book_id)}}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100">
                                            <i class="fa-solid fa-heart me-1"></i> Remove from Wishlist
                                        </button>
                                    </form>
                                    @else
                                    @if($wishlist)
                                    <form action="{{route('account.wishlist.items.add', $book->book_id)}}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <input type="hidden" name="wish_list_id" value="{{ $wishlist->wish_list_id }}">
                                        <input type="hidden" name="book_id" value="{{ $book->book_id }}">
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle"
                                            title="Add to Wishlist">
                                            <i class="fa-regular fa-heart"></i>
                                        </button>
                                    </form>
                                    @else
                                    
                                    @endif

                                    @endif
                                </div>
                                @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <h4>No Books Found</h4>
                        <p>Sorry, no books match your search criteria.</p>
                    </div>
                </div>
                @endif
            </div>
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    {{$books->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection