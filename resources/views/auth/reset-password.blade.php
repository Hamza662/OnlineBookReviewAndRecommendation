<!DOCTYPE html>
<html>
<head>
    <title>New Password</title>
    <style>
        body { font-family: Arial; max-width: 400px; margin: 50px auto; padding: 20px; }
        input { width: 100%; padding: 10px; margin: 10px 0; }
        button { background: #007bff; color: white; padding: 10px 20px; border: none; }
        .error { color: red; }
    </style>
</head>
<body>
    <h2>Naya Password Set Karein</h2>
    
    @if ($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Naya Password" required>
        <input type="password" name="password_confirmation" placeholder="Password Confirm" required>
        <button type="submit">Password Update Karein</button>
    </form>
</body>
</html>