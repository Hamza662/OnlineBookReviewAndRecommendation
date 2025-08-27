<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
    <style>
        body { font-family: Arial; max-width: 400px; margin: 50px auto; padding: 20px; }
        input { width: 100%; padding: 10px; margin: 10px 0; }
        button { background: #007bff; color: white; padding: 10px 20px; border: none; }
        .alert { padding: 10px; margin: 10px 0; background: #d4edda; }
        .error { background: #f8d7da; }
    </style>
</head>
<body>
    <h2>Password Reset</h2>
    
    @if (session('status'))
        <div class="alert">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <input type="email" name="email" placeholder="Email address" required>
        <button type="submit">Give the resend link.</button>
    </form>
</body>
</html>