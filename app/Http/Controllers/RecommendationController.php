<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookRecommendationNotification;
use Illuminate\Support\Facades\Auth;

class RecommendationController extends Controller
{
    public function recommendBook(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:book,book_id',
            'user_id' => 'required|exists:user,user_id',
            'message' => 'nullable|string|max:500'
        ]);

        // Get book and user details
        $book = Book::findOrFail($request->book_id);
        $targetUser = User::findOrFail($request->user_id);
        $recommender = auth::user();

        // Save notification
        DB::table('notifications')->insert([
            'user_id' => $targetUser->id,
            'notification_type' => 'recommendation',
            'is_read' => false,
            'related_id' => $book->id,
            'message' => $request->message ?? "You have a new book recommendation: {$book->title}"
        ]);

        // Send email
        if ($targetUser->email) {
            Mail::to($targetUser->email)->send(new BookRecommendationNotification($targetUser, $book, $recommender->name));
        }

        return back()->with('success', 'Book recommended and email sent!');
    }
}
