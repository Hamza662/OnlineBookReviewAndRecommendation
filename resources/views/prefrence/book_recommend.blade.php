@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-9">
            @include('layouts.message')
            <!-- User Preferences Section -->
            @if($userPreferences->isNotEmpty())
            <div class="card border-0"
                style="box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); margin-bottom: 20px;">
                <div class="card-header text-white"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                    <h5 style="margin: 0; display: flex; align-items: center;">
                        <i class="fas fa-heart" style="margin-right: 10px; color: #ff6b6b;"></i>
                        Your Reading Preferences
                    </h5>
                </div>
                <div class="card-body" style="padding: 20px; background-color: #f8f9fa;">
                    <div class="row">
                        @foreach($userPreferences as $preference)
                        <div class="col-md-4" style="margin-bottom: 15px;">
                            <div class="card"
                                style="border: none; border-left: 4px solid #007bff; box-shadow: 0 2px 4px rgba(0,0,0,0.1); transition: transform 0.2s ease;"
                                onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 15px rgba(0, 0, 0, 0.2)'"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)'">
                                <div class="card-body" style="padding: 15px;">
                                    <h6 style="margin: 0 0 10px 0; color: #495057; font-weight: 600;">
                                        <i class="fas fa-tag" style="margin-right: 8px; color: #6c757d;"></i>
                                        {{ $preference->genre->genre_name ?? 'Unknown Genre' }}
                                    </h6>
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <span class="badge"
                                            style="background-color: #007bff; font-size: 0.8rem; padding: 4px 8px;">
                                            Weight: {{ $preference->preference_weight }}
                                        </span>
                                        <small style="color: #6c757d;">
                                            {{ $preference->is_active == 1 ? 'Active' : 'Inactive' }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            <!-- Recommended Books Section -->
            <div class="card border-0" style="box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);">
                <div class="card-header text-white"
                    style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); border: none;">
                    <h5 style="margin: 0; display: flex; align-items: center;">
                        <i class="fas fa-book" style="margin-right: 10px; color: #ffd700;"></i>
                        Recommended Books For You
                    </h5>
                </div>
                <div class="card-body" style="padding: 25px; background-color: #ffffff;">
                    @if($recommendedBooks->isNotEmpty())
                    <div class="row">
                        @foreach($recommendedBooks as $book)
                        <div class="col-lg-3 col-md-4 col-sm-6" style="margin-bottom: 25px;">
                            <div class="card"
                                style="border: none; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; height: 100%;"
                                onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 15px rgba(0, 0, 0, 0.2)'"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px rgba(0, 0, 0, 0.1)'">
                                <!-- Book Cover -->
                                <div
                                    style="position: relative; height: 220px; overflow: hidden; border-radius: 12px 12px 0 0; background: linear-gradient(45deg, #f8f9fa, #e9ecef);">
                                    @if($book->cover_img)
                                    <img src="{{ asset('uploads/books/thumb/' . $book->cover_img) }}"
                                        alt="{{ $book->title }}"
                                        style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;"
                                        onmouseover="this.style.transform='scale(1.05)'"
                                        onmouseout="this.style.transform='scale(1)'">
                                    @else
                                    <div
                                        style="display: flex; align-items: center; justify-content: center; height: 100%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                        <i class="fas fa-book"
                                            style="font-size: 3rem; color: rgba(255,255,255,0.7);"></i>
                                    </div>
                                    @endif
                                </div>

                                <!-- Book Info -->
                                <div class="card-body"
                                    style="padding: 20px; display: flex; flex-direction: column; flex-grow: 1;">
                                    <h6
                                        style="margin: 0 0 10px 0; font-weight: 600; color: #2c3e50; line-height: 1.3; height: 40px; overflow: hidden;">
                                        {{ Str::limit($book->title, 50) }}
                                    </h6>

                                    <p
                                        style="margin: 0 0 12px 0; color: #6c757d; font-size: 0.9rem; display: flex; align-items: center;">
                                        <i class="fas fa-user" style="margin-right: 6px; font-size: 0.8rem;"></i>
                                        {{ Str::limit($book->author, 30) }}
                                    </p>

                                    <!-- Genres -->
                                    <div style="margin-bottom: 15px; min-height: 25px;">
                                        @foreach($book->genres as $genre)
                                        <span class="badge"
                                            style="background-color: #17a2b8; margin-right: 5px; margin-bottom: 3px; font-size: 0.7rem; padding: 3px 6px;">
                                            {{ $genre->genre_name }}
                                        </span>
                                        @endforeach
                                    </div>

                                    <!-- Action Button -->
                                    <div style="margin-top: auto;">
                                        <a href="{{ route('book.detail', $book->book_id) }}" class="btn btn-primary"
                                            style="width: 80%; border-radius: 6px; font-weight: 500; padding: 8px 12px; font-size: 0.85rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; transition: all 0.3s ease; text-decoration: none; color: white; display: flex; align-items: center; justify-content: center; margin: 0 auto; height: 38px;"
                                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 8px rgba(0, 0, 0, 0.2)'"
                                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                                            <i class="fas fa-eye" style="margin-right: 6px; font-size: 0.8rem;"></i>
                                            <span>View Details</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if(method_exists($recommendedBooks, 'links'))
                    <div style="margin-top: 30px; display: flex; justify-content: center;">
                        {{ $recommendedBooks->links() }}
                    </div>
                    @endif
                    @else
                    <!-- No Recommendations -->
                    <div style="text-align: center; padding: 60px 20px; color: #6c757d;">
                        <div style="margin-bottom: 20px;">
                            <i class="fas fa-book-open" style="font-size: 4rem; color: #dee2e6;"></i>
                        </div>
                        <h4 style="color: #6c757d; margin-bottom: 15px; font-weight: 500;">
                            No Recommendations Yet
                        </h4>
                        <p style="margin-bottom: 25px; font-size: 1.1rem; line-height: 1.6;">
                            Set your reading preferences to get personalized book recommendations!
                        </p>
                        <a href="{{ route('prefrences.index') }}" class="btn btn-primary"
                            style="padding: 12px 30px; font-size: 1.1rem; border-radius: 25px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; text-decoration: none; color: white; transition: all 0.3s ease;"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 8px rgba(0, 0, 0, 0.2)'"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            <i class="fas fa-cog" style="margin-right: 8px;"></i>
                            Set Your Preferences
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection