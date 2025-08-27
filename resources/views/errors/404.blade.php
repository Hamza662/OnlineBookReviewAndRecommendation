<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - Book Review App</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Arvo:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /*======================
            404 page
        =======================*/
        .page_404 {
            padding: 0;
            background: #fff;
            font-family: 'Arvo', serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .page_404 img {
            width: 100%;
        }

        .four_zero_four_bg {
            background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
            height: 500px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .four_zero_four_bg h1 {
            font-size: 120px;
            color: #333;
            margin: 0;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .four_zero_four_bg h3 {
            font-size: 80px;
        }

        .link_404 {
            color: #fff !important;
            padding: 15px 30px;
            background: #39ac31;
            margin: 30px 0;
            display: inline-block;
            text-decoration: none;
            border-radius: 25px;
            font-size: 18px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .link_404:hover {
            color: #fff !important;
            background: #2e8c28;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(57, 172, 49, 0.4);
        }

        .contant_box_404 {
            margin-top: 30px;
            text-align: center;
        }

        .contant_box_404 h3 {
            font-size: 36px;
            color: #333;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .contant_box_404 p {
            font-size: 20px;
            color: #666;
            margin-bottom: 30px;
        }

        .error-container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }
    </style>
</head>

<body>
    <section class="page_404">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="error-container">
                        <div class="four_zero_four_bg">
                            <h1 class="text-center" style="margin-bottom: 275px;">404</h1>
                        </div>

                        <div class="contant_box_404">
                            <h3>
                                Look like you're lost
                            </h3>

                            <p>The page you are looking for is not available!</p>

                            @auth
                            @php
                            $user = auth()->user();
                            $userRole = $user->role ?? $user->user_type ?? 'user';
                            @endphp
                            @if($userRole === 'admin' || $userRole == 1)
                            <a href="{{ url('/dashboard') }}" class="link_404">Go to Dashboard</a>
                            @else
                            <a href="{{ url('admin/dashboard') }}" class="link_404">Go to Home</a>
                            @endif
                            @else
                            <a href="{{ url('admin/dashboard') }}" class="link_404">Go to Home</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>