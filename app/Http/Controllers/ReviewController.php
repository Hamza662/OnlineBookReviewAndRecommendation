<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Review;
// use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\ImageManager;
use App\Mail\ReviewReplyNotification;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;


class ReviewController extends Controller
{
    public function index()
    {

        $reviews = Review::with(['book', 'genres', 'user'])
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        // Get review IDs from the paginated reviews
        $reviewIds = $reviews->pluck('review_id');

        // Fetch replies using Eloquent
        $replies = Notification::with([
            'user',
            'review.user'
        ])
            ->where('notification_type', 'review_reply')
            ->whereIn('review_id', $reviewIds)
            ->orderBy('notification_id', 'ASC')
            ->get()
            ->groupBy('review_id');

        return view('account.reviews.list', compact('reviews', 'replies'));
    }

    public function saveReview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:book,book_id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        $countReview = Review::where('user_id', Auth::user()->user_id)->where('book_id', $request->book_id)->count();

        if ($countReview > 0) {
            session()->flash('error', 'You already sumitted a review');
            return response([
                'status' => true,

            ]);
        }
        Review::create([
            'book_id' => $request->book_id,
            'user_id' => Auth::user()->user_id,
            'rating' => $request->rating,
            'review' => $request->review,
            'last_edited_date' => now(),
        ]);

        session()->flash('success', 'Review submitted succesfully.');
        return response([
            'status' => true,

        ]);
    }

    public function edit(string $id)
    {
        $review = Review::with('book')->findOrFail($id);
        $books = Book::all();
        return view('account.reviews.edit', compact('review', 'books'));
    }

    public function updateReview($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'review' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
            'book_id' => 'nullable|exists:book,book_id',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $review = Review::findOrFail($id);
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->book_id = $request->book_id;
        $review->save();

        return redirect()->route('account.reviews')->with('success', 'Review updated successfully.');
    }

    public function deleteReview(Request $request)
    {
        $id = $request->review_id;
        $review = Review::find($id);

        if ($review == null) {
            session()->flash('error', 'Review Id not found.');
            return response()->json([
                'status' => false
            ]);
        } else {
            $review->delete();
            session()->flash('success', 'Review deleted successfully.');
            return response()->json([
                'status' => false
            ]);
        }
    }


    public function storeReply(Request $request, $reviewId)
    {
        try {
            // Debug info
            Log::info('Reply request received', [
                'reviewId' => $reviewId,
                'message' => $request->message,
                'user_id' => auth::id()
            ]);

            // 1. Validate input
            $request->validate([
                'message' => 'required|string|max:1000',
            ]);

            // 2. Find the original review
            $review = Review::find($reviewId);

            if (!$review) {
                return response()->json(['error' => 'Review not found'], 404);
            }

            Log::info('Review found', ['review' => $review->toArray()]);

            // 3. Get the user who wrote the review
            $originalReviewUser = User::find($review->user_id);

            if (!$originalReviewUser) {
                return response()->json(['error' => 'Original user not found'], 404);
            }

            Log::info('Original user found', ['user' => $originalReviewUser->toArray()]);

            // 4. Save notification
            $notificationId = DB::table('notifications')->insertGetId([
                'user_id' => auth::id(),
                'notification_type' => 'review_reply',
                'is_read' => 0,
                'related_id' => $reviewId,
                'review_id' => $reviewId,
                'message' => $request->message
            ]);

            Log::info('Notification saved', ['id' => $notificationId]);

            // 5. Send email
            if ($originalReviewUser->email) {
                Mail::to($originalReviewUser->email)->send(new ReviewReplyNotification($originalReviewUser, $request->message, $reviewId));
                Log::info('Email sent to', ['email' => $originalReviewUser->email]);
            }

            return response()->json(['success' => true, 'message' => 'Reply posted successfully!']);
        } catch (\Exception $e) {
            Log::error('Reply error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    // Controller mein ye method add karein
    public function updateReply(Request $request, $replyId)
    {
        try {
            // Debug info
            Log::info('Update reply request received', [
                'replyId' => $replyId,
                'message' => $request->message,
                'user_id' => auth::id()
            ]);

            // 1. Validate input
            $request->validate([
                'message' => 'required|string|max:1000',
            ]);

            // 2. Find the reply using Notification model
            $reply = Notification::where('notification_id', $replyId)
                ->where('user_id', auth::id())
                ->where('notification_type', 'review_reply')
                ->first();

            if (!$reply) {
                return response()->json(['error' => 'Reply not found or you are not authorized to edit this reply'], 404);
            }

            Log::info('Reply found', ['reply' => $reply]);

            // 3. Update the reply
            $reply->message = $request->message;
            $updated = $reply->save();

            if ($updated) {
                Log::info('Reply updated successfully', ['replyId' => $replyId]);
                return response()->json(['success' => true, 'message' => 'Reply updated successfully!']);
            } else {
                return response()->json(['error' => 'Failed to update reply'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Update reply error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function deleteReply(Request $request)
    {
        try {
            $replyId = $request->reply_id;

            // Debug info
            Log::info('Delete reply request received', [
                'replyId' => $replyId,
                'user_id' => auth::id()
            ]);

            // 1. Find the reply and check if user owns it
            $reply = DB::table('notifications')
                ->where('notification_id', $replyId)
                ->where('user_id', auth::id())
                ->where('notification_type', 'review_reply')
                ->first();

            if (!$reply) {
                return response()->json(['error' => 'Reply not found or you are not authorized to delete this reply'], 404);
            }

            Log::info('Reply found for deletion', ['reply' => $reply]);

            // 2. Delete the reply
            $deleted = DB::table('notifications')
                ->where('notification_id', $replyId)
                ->where('user_id', auth::id())
                ->where('notification_type', 'review_reply')
                ->delete();

            if ($deleted) {
                Log::info('Reply deleted successfully', ['replyId' => $replyId]);
                return response()->json(['success' => true, 'message' => 'Reply deleted successfully!']);
            } else {
                return response()->json(['error' => 'Failed to delete reply'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Delete reply error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
