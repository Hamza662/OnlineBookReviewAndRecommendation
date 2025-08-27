<!DOCTYPE html>
<html>

<head>
    <title>New Book Recommendation</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 20px;">

    <h2>Hello {{ $user->name }}!</h2>

    <p>You have received a new book recommendation!</p>

    <div style="background-color: #f8f9fa; padding: 20px; border: 1px solid #dee2e6; border-radius: 5px;">
        <h3 style="color: #28a745;">📚 {{ $book->title ?? 'Recommended Book' }}</h3>

        @if(isset($book->author))
        <p><strong>Author:</strong> {{ $book->author }}</p>
        @endif

        @if($recommenderName)
        <p><strong>Recommended by:</strong> {{ $recommenderName }}</p>
        @endif
    </div>

    <p>
        <a href="{{ route('book.detail' , $book->book_id ?? 1) }}"
            style="background-color: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
            View Book Details
        </a>
    </p>

    <p>Happy Reading!</p>

</body>

</html>