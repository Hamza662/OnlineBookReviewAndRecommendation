<!DOCTYPE html>
<html>
<head>
    <title>New Reply on Your Review</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 20px;">
    
    <h2>Hello {{ $user->name }}!</h2>
    
    <p>Someone has replied to your book review.</p>
    
    <div style="background-color: #f4f4f4; padding: 15px; border-left: 4px solid #007bff;">
        <strong>Reply:</strong>
        <p>{{ $replyMessage }}</p>
    </div>
    
    <p>
        <a href="{{ route('account.myReviews.show',$reviewId) }}" style="background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
            View your review.
        </a>
    </p>
    
    <p>Thank you for using our Book Review Platform!</p>
    
</body>
</html>