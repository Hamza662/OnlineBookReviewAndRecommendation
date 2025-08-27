<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use App\Models\Genre;
use App\Models\ReviewReport;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $primaryKey = 'review_id';
    // public $timestamps = false;

    protected $fillable = [
        'review_id',
        'book_id',
        'user_id',
        'rating',
        'review',
        'last_edited_date',
        'is_flaged'
    ];
    
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'book_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function genres()
    {
        return $this->belongsTo(Genre::class, 'genre_id', 'genre_id');
    }

    public function reports()
    {
        return $this->hasMany(ReviewReport::class, 'review_id');
    }

    
}
