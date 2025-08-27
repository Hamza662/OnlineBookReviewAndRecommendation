<?php

namespace App\Models;

use App\Models\User;
use App\Models\Genre;
use App\Models\Review;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $table = 'book';
    protected $primaryKey = 'book_id';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'author',
        'description',
        'cover_img',
        'publisher_year',
        'publisher',
        'page_count',
        'language',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genres', 'book_id', 'genre_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'book_id', 'book_id');
    }

    
}
