<?php

namespace App\Models;

use App\Models\Book;
use App\Models\WishList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WishListItem extends Model
{
    use HasFactory;

    protected $table = 'wish_list_items';
    protected $primaryKey = 'wish_list_item_id';
    public $timestamps = false;

    protected $fillable = [
        'wish_list_id',
        'book_id',
        'date_added'
    ];

    protected $casts = [
        'date_added' => 'datetime'
    ];

    public function wishList()
    {
        return $this->belongsTo(WishList::class, 'wish_list_id', 'wish_list_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
