<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use App\Models\WishListItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WishList extends Model
{
    use HasFactory;
    protected $table = 'wish_list';
    protected $primaryKey = 'wish_list_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'name',
        'creation_date',
        'is_public'
    ];
    protected $casts = [
        'creation_date' => 'datetime',
        'is_public' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function wishlistItems()
    {
        return $this->hasMany(WishListItem::class, 'wish_list_id', 'wish_list_id');
    }


    public function books()
    {
        return $this->hasManyThrough(Book::class, WishListItem::class, 'wish_list_id', 'id', 'wish_list_id', 'book_id');
    }

    public function getTotalBooksAttribute()
    {
        return $this->wishlistItems()->count();
    }

    public function hasBook($bookId)
    {
        return $this->wishlistItems()->where('book_id', $bookId)->exists();
    }

}
