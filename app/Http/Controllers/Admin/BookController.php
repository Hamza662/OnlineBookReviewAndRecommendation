<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = Auth::user()->user_id;
        $books = Book::with(['genres', 'user'])->where('user_id', $userId)->orderBy('book_id', 'DESC');

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
        return view("admin.books.list", compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        return view('admin.books.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|min:5',
            'author' => 'required',
            'description' => 'nullable|string',
            'cover_img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'publisher_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'publisher' => 'nullable|string|max:255',
            'page_count' => 'nullable|integer|min:1',
            'language' => 'required|string|max:100',
            'genre_id' => 'required|exists:genres,genre_id'
        ];
        if (!empty($request->cover_img)) {
            $rules['cover_img'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('admin.books.create')->withInput()->withErrors($validator);
        }

        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->language = $request->language;
        $book->description = $request->description;
        // $book->cover_img = $request->cover_img;
        $book->publisher_year = $request->publisher_year;
        $book->publisher = $request->publisher;
        $book->page_count = $request->page_count;
        $book->user_id = Auth::id();
        $book->save();

        if (!empty($request->cover_img)) {
            $img = $request->cover_img;
            $ext = $img->getClientOriginalExtension();
            $imgName = time() . '.' . $ext;
            $img->move(public_path('uploads/books/'), $imgName);
            $book->cover_img = $imgName;
            $book->save();

            $manager = new ImageManager(Driver::class);
            $image = $manager->read(public_path('uploads/books/' . $imgName));
            $image->resize(990);
            $image->save('uploads/books/thumb/' . $imgName);
            DB::table('book_genres')->insert([
                'book_id' => $book->book_id,
                'genre_id' => $request->genre_id,
            ]);
        }
        return redirect()->route('admin.books.index')->with('success', 'Book added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::withCount('reviews')->withSum('reviews', 'rating')->with(['genres', 'user'])->findOrFail($id);
        return view('admin.books.book_detail', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::with('genres')->findOrFail($id);
        $genres = Genre::all();

        return view('admin.books.edit', compact('genres', 'book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'title' => 'required|min:5',
            'author' => 'required',
            'description' => 'nullable|string',
            'cover_img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'publisher_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'publisher' => 'nullable|string|max:255',
            'page_count' => 'nullable|integer|min:1',
            'language' => 'required|string|max:100',
            'genre_id' => 'required|exists:genres,genre_id'
        ];
        if (!empty($request->cover_img)) {
            $rules['cover_img'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('admin.books.edit')->withInput()->withErrors($validator);
        }

        $book = Book::with('genres')->findOrFail($id);
        $book->title = $request->title;
        $book->author = $request->author;
        $book->language = $request->language;
        $book->description = $request->description;
        // $book->cover_img = $request->cover_img;
        $book->publisher_year = $request->publisher_year;
        $book->publisher = $request->publisher;
        $book->page_count = $request->page_count;
        $book->user_id = Auth::id();
        $book->genres()->sync([$request->genre_id]);
        // dd($request->genre_id);
        $book->save();

        if (!empty($request->cover_img)) {

            File::delete('uploads/books/' . $book->cover_img);

            File::delete('uploads/books/thumb/' . $book->cover_img);

            $img = $request->cover_img;
            $ext = $img->getClientOriginalExtension();
            $imgName = time() . '.' . $ext;
            $img->move(public_path('uploads/books/'), $imgName);
            $book->cover_img = $imgName;
            $book->save();

            $manager = new ImageManager(Driver::class);
            $image = $manager->read(public_path('uploads/books/' . $imgName));
            $image->resize(990);
            $image->save('uploads/books/thumb/' . $imgName);
        }
        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Start database transaction for safety
            DB::beginTransaction();

            $book = Book::findOrFail($id);

            if ($book == null) {
                DB::rollBack();
                session()->flash('error', 'Book not found.');
                return response()->json([
                    'status' => false,
                    'message' => 'Book not found.'
                ]);
            }

            // Count reviews before deletion (for success message)
            $reviewCount = $book->reviews()->count();

            // Step 1: Delete all reviews for this book FIRST
            $book->reviews()->delete();

            // Step 2: Delete book cover images
            if ($book->cover_img) {
                File::delete(public_path('uploads/books/' . $book->cover_img));
                File::delete(public_path('uploads/books/thumb/' . $book->cover_img));
            }

            // Step 3: Delete the book
            $book->delete();

            // Commit transaction
            DB::commit();

            // Success message with review count
            $message = $reviewCount > 0
                ? "Book and {$reviewCount} reviews deleted successfully."
                : "Book deleted successfully.";

            session()->flash('success', $message);

            return response()->json([
                'status' => true,
                'message' => $message,
                'reviews_deleted' => $reviewCount
            ]);
        } catch (\Exception $e) {
            // Rollback transaction on any error
            DB::rollBack();

            // Log error for debugging
            Log::error('Book deletion failed: ' . $e->getMessage());

            session()->flash('error', 'Failed to delete book. Please try again.');

            return response()->json([
                'status' => false,
                'message' => 'Failed to delete book: ' . $e->getMessage()
            ], 500);
        }
    }
}
