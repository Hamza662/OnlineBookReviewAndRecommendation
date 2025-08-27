<div class="card border-0 shadow-lg">
    <div class="card-header  text-white">
        Welcome, {{Auth::user()->name}}
    </div>
    <div class="card-body">
        <div class="text-center mb-3">
            <img src="{{ asset('uploads/profile/thumb/' . (Auth::user()->img ?? 'no_image.jpg')) }}"
                class="img-fluid mt-4 rounded-circle" alt="{{ Auth::user()->name }}">
        </div>
        <div class="h5 text-center">
            <strong>{{Auth::user()->name}}</strong>
            <p class="h6 mt-2 text-muted">{{(Auth::user()->reviews->count() > 1) ? Auth::user()->reviews->count() .
                'Reviews' : Auth::user()->reviews->count() . 'Review'}} </p>
        </div>
    </div>
</div>
<div class="card border-0 shadow-lg mt-3">
    <div class="card-header  text-white">
        Navigation
    </div>
    <div class="card-body sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{route('home')}}">Home</a>
            </li>
            @auth
            @if(auth()->user()->role === 'admin')
            <li class="nav-item">
                <a href="{{ route('admin.books.index') }}">Books</a>
            </li>
            @endif
            @endauth
            <li class="nav-item">
                <a href="{{ route('account.reviews') }}">All Reviews</a>
            </li>

            <li class="nav-item">
                <a href="{{route('account.profile')}}">Profile</a>
            </li>
            <li class="nav-item">
                <a href="{{route('account.myReviews')}}">My Reviews</a>
            </li>
            <li class="nav-item">
                <a href="{{route('prefrences.index')}}">My Preferences</a>
            </li>
            <li class="nav-item">
                <a href="{{route('api.recommendations')}}">Recommended Book</a>
            </li>
            <li class="nav-item">
                <a href="{{route('account.wishlists.index')}}">My Wishlists</a>
            </li>
             <li class="nav-item">
                <a href="{{route('about')}}">About Us</a>
            </li>
            <li class="nav-item">
                <a href="{{route('account.logout')}}">Logout</a>
            </li>
        </ul>
    </div>
</div>