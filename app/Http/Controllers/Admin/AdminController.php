<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::withCount('reviews')->withSum('reviews', 'rating')->with(['genres', 'user'])->orderBy('book_id', 'DESC');

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
        return view("admin.dashboard", compact('books'));
    }
    public function BookDetail($id)
    {
        $book = Book::withCount('reviews')->withSum('reviews', 'rating')->with(['genres', 'user'])->findOrFail($id);
        return view('admin.book_detail_admin_side', compact('book'));
    }


    

    // public function contact()
    // {
    //     return view('pages.contact');
    // }
}
