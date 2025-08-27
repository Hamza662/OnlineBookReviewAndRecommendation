<?php

namespace App\Models;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserPrefrence;

class Genre extends Model
{
    protected $primaryKey = 'genre_id';
    // protected $primaryKey = 'genre_id';
    protected $fillable = [
        'genre_name',
        'description'
    ];
    public $timestamps = false; 

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_genres', 'genre_id', 'book_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'genre_id', 'genre_id');
    }

    public function prefrences()
    {
        return $this->hasMany(UserPrefrence::class, 'genre_id', 'genre_id');
    }
}
