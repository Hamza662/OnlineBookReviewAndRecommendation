<?php

namespace App\Models;

use App\Models\User;
use App\Models\Review;
use Illuminate\Database\Eloquent\Model;

class ReviewReport extends Model
{
    protected $primaryKey = 'review_report_id';
    public $timestamps = false;

    protected $fillable = [
        'review_report_id',
        'review_id',
        'user_id',
        'reason',
        'report_date',
        'status',
        'admin_notes'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function review()
    {
        return $this->belongsTo(Review::class, 'review_id');
    }

    public static function checkExistingReport($user_id, $review_id)
    {
        return self::where('user_id', $user_id)
            ->where('review_id', $review_id)
            ->exists();
    }

    public static function getPendingReports()
    {
        return self::with(['user', 'review'])
            ->where('status', 'Pending')
            ->get();
    }
}
