<?php

namespace App\Models;

use App\Models\User;
use App\Models\Review;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $primaryKey = 'notification_id'; // agar primary key ka naam alag hai

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'notification_type',
        'review_id',
        'related_id',
        'message',
        'is_read',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function review() {
        return $this->belongsTo(Review::class, 'review_id');
    }
}
