<?php

namespace App\Http\Controllers\Admin;

use illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminRController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['book', 'genres'])
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
        return view('admin.reviews.index', compact('reviews','replies'));
    }


    public function deleteUserReview(Request $request)
    {
        $id = $request->review_id;
        $review = Review::find($id);

        if ($review == null) {
            session()->flash('error', 'Review not found.');
            return response()->json([
                'status' => false,
                'message' => 'Review not found.'
            ]);
        }

        // Check if user is admin OR the review owner
        if (auth::user()->role == 'admin' || $review->user_id == auth::id()) {
            $review->delete();
            session()->flash('success', 'Review deleted successfully.');
            return response()->json([
                'status' => true,
                'message' => 'Review deleted successfully.'
            ]);
        } else {
            session()->flash('error', 'You are not authorized to delete this review.');
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access.'
            ]);
        }
    }
}
