<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::withCount('reviews')->withSum('reviews', 'rating')->with(['genres', 'user'])->orderBy('book_id', 'DESC');

        $wishlist = WishList::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'name' => 'My Wishlist',
                'is_public' => false,
                'creation_date' => now()
                ]
            );


        if (!empty($request->keyword)) {
            $keyword = $request->keyword;

            $books->where(function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('author', 'like', '%' . $keyword . '%')
                    ->orWhereHas('genres', function ($q) use ($keyword) {
                        $q->where('genre_name', 'like', '%' . $keyword . '%');
                    });
            });
        }
        $books = $books->paginate(10);
        // dd($books);
        return view("home", compact('books', 'wishlist'));
    }

    public function detail($id)
    {
        $book = Book::withCount('reviews')->withSum('reviews', 'rating')->with(['genres', 'user'])->findOrFail($id);
        return view('detail_book', compact('book'));
    }
}
