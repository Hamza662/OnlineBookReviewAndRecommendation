<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Review App</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @yield('styles')
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

</head>

<body class="bg-light">
    <div class="container-fluid shadow-lg header">
        <div class="container">
            <div class="d-flex justify-content-between">
                <h1 class="text-center"><a href="{{route('home')}}" class="h3 text-white text-decoration-none">Book
                        Review
                        App</a></h1>
                <div class="d-flex align-items-center navigation">
                    @if(Auth::check())
                    <a href="{{route('account.profile')}}" class="text-white">My Account</a>
                    @else
                    <a href="{{route('account.login')}}" class="text-white">Login</a>
                    <a href="{{route('account.register')}}" class="text-white ps-2">Register</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @yield('main')
    <!-- ✅ Load jQuery FIRST -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- ✅ Then load Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- ✅ Then Bootstrap or other JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- CDN (Only for testing / quick check) -->
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}

    <!-- Your custom script -->
    @yield('script')


</body>

</html>