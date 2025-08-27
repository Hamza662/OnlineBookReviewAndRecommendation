@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">

    <div class="row justify-content-center d-flex mt-5">
        <div class="col-md-12">

            <!-- 🌟 Attractive Heading -->
            <div style="text-align: center; margin-bottom: 30px;">
                <h2 style="font-weight: 700; font-size: 32px; color: #2c3e50;">
                    📚 Explore the Book Collection
                </h2>
                <p style="color: #7f8c8d; font-size: 16px;">
                    Dive into the world of stories, knowledge, and imagination
                </p>
            </div>

            <div class="row mt-4">
                @if($books->isNotEmpty())
                @foreach ($books as $book)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div style="border: none; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1); transition: transform 0.3s ease; min-height: 420px;"
                        onmouseover="this.style.transform='translateY(-5px)'"
                        onmouseout="this.style.transform='translateY(0)'">
                        <a href="{{ route('admin.book.detail', $book->book_id) }}">
                            <img src="{{ $book->cover_img ? asset('uploads/books/thumb/'.$book->cover_img) : asset('images/no_image.jpg') }}"
                                alt="{{ $book->title }}" style="width: 100%; height: 250px; object-fit: cover;">
                        </a>
                        <div
                            style="padding: 15px; display: flex; flex-direction: column; justify-content: space-between; height: 170px;">
                            <div>
                                <h5 style="margin: 0 0 5px 0; font-weight: 600; font-size: 18px;">
                                    <a href="{{ route('admin.book.detail', $book->book_id) }}"
                                        style="text-decoration: none; color: #333;">{{ $book->title }}</a>
                                </h5>
                                <p style="margin: 0 0 10px 0; color: #777;">by {{ $book->author }}</p>
                            </div>

                            @php
                            $avgRating = $book->reviews_count > 0 ? $book->reviews_sum_rating / $book->reviews_count :
                            0;
                            $avgRatingPer = ($avgRating * 100) / 5;
                            @endphp

                            <div>
                                <div style="display: flex; align-items: center; margin-bottom: 4px;">
                                    <span style="font-weight: bold; color: #ffc107; margin-right: 8px;">
                                        {{ number_format($avgRating, 1) }}
                                    </span>
                                    <div style="position: relative; display: inline-block; font-size: 16px;">
                                        <div style="color: #ddd;">
                                            ★★★★★
                                        </div>
                                        <div
                                            style="position: absolute; top: 0; left: 0; white-space: nowrap; overflow: hidden; width: {{ $avgRatingPer }}%; color: #ffc107;">
                                            ★★★★★
                                        </div>
                                    </div>
                                </div>
                                <small style="color: #999;">
                                    ({{ $book->reviews_count }} {{ Str::plural('Review', $book->reviews_count) }})
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-12">
                    <div style="text-align: center; padding: 40px; background-color: #f8f9fa; border-radius: 10px;">
                        <h4 style="color: #555;">No Books Found</h4>
                        <p style="color: #888;">Sorry, no books match your search criteria.</p>
                    </div>
                </div>
                @endif
            </div>

            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    <div style="margin-top: 20px;">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection