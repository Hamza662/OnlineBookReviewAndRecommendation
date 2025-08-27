<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.dashboard')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.books.index') }}">
                <i class="icon-book menu-icon"></i>
                <span class="menu-title">Books</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.admin.reviews') }}">
                <i class="fas fa-star menu-icon"></i>
                <span class="menu-title">Reviews</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.reports') }}" class="nav-link">
                <i class="fas fa-flag menu-icon" style="color: #6c757d; margin-right: 10px;"></i>
                <span class="menu-title">View Reported Reviews</span>
            </a>
        </li>

        {{-- <li class="nav-item">
            <a href="{{ route('admin.about') }}" class="nav-link">
                <i class="fas fa-info-circle menu-icon" style="color: #6c757d; margin-right: 10px;"></i>
                <span class="menu-title">About Us</span>
            </a>
        </li> --}}


    </ul>
</nav>