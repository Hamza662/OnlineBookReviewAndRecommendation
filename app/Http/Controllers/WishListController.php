<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\WishList;
use App\Models\WishListItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function index()
    {
        $wishlists = WishList::where('user_id', Auth::id())
            ->withCount('wishlistItems')
            ->orderBy('creation_date', 'desc')
            ->get();

        return view('account.wishlists.index', compact('wishlists'));
    }


    public function show($wishListId)
    {
        $wishlist = WishList::where('wish_list_id', $wishListId)
            ->where('user_id', Auth::id())
            ->with(['wishlistItems.book'])
            ->firstOrFail();

        return view('account.wishlists.show', compact('wishlist'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'is_public' => 'nullable|in:0,1'
            ]);

            $wishlist = WishList::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'creation_date' => Carbon::now(),
                'is_public' => $request->has('is_public') ? 1 : 0
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Wishlist created successfully!',
                'wishlist_id' => $wishlist->wish_list_id
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating wishlist: ' . $e->getMessage()
            ], 500);
        }
    }



    public function update(Request $request, $wishListId)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'is_public' => 'nullable|in:0,1'
            ]);

            $wishlist = WishList::where('wish_list_id', $wishListId)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $wishlist->update([
                'name' => $request->name,
                'is_public' => $request->has('is_public') ? 1 : 0
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Wishlist updated successfully!'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating wishlist: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($wishListId)
    {
        $wishlist = WishList::where('wish_list_id', $wishListId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Delete all wishlist items first
        WishListItem::where('wish_list_id', $wishListId)->delete();

        // Delete wishlist
        $wishlist->delete();

        return response()->json([
            'success' => true,
            'message' => 'Wishlist deleted successfully!'
        ]);
    }


    // Add book to wishlist
    public function addBook(Request $request)
    {
        $request->validate([
            'wish_list_id' => 'required|exists:wish_list,wish_list_id',
            'book_id' => 'required|exists:book,book_id'
        ]);

        $wishlist = WishList::where('wish_list_id', $request->wish_list_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $existingItem = WishListItem::where('wish_list_id', $request->wish_list_id)
            ->where('book_id', $request->book_id)
            ->first();

        if ($existingItem) {
            return redirect()->route('home')->with('error', 'Book already exists in this wishlist!');
        }

        WishListItem::create([
            'wish_list_id' => $request->wish_list_id,
            'book_id' => $request->book_id,
            'date_added' => Carbon::now()
        ]);

        return redirect()->route('home')->with('success', 'Book added to wishlist successfully!');
    }



    // Remove book from wishlist
    public function removeBook(Request $request)
    {
        $request->validate([
            'wish_list_id' => 'required|exists:wish_list,wish_list_id',
            'book_id' => 'required|exists:book,book_id'
        ]);

        $wishlist = WishList::where('wish_list_id', $request->wish_list_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $deleted = WishListItem::where('wish_list_id', $request->wish_list_id)
            ->where('book_id', $request->book_id)
            ->delete();

        if ($deleted) {
            return redirect()->route('home')->with('success', 'Book removed from wishlist successfully!');
        } else {
            return redirect()->route('home')->with('error', 'Book not found in wishlist!');
        }
    }



    // Quick add to default wishlist
    public function quickAdd(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:book,book_id'
        ]);

        // Get or create default wishlist
        $defaultWishlist = WishList::firstOrCreate([
            'user_id' => Auth::id(),
            'name' => 'My Wishlist'
        ], [
            'creation_date' => Carbon::now(),
            'is_public' => 0
        ]);

        // Check if book already exists
        $existingItem = WishListItem::where('wish_list_id', $defaultWishlist->wish_list_id)
            ->where('book_id', $request->book_id)
            ->first();

        if ($existingItem) {
            // Remove from wishlist
            $existingItem->delete();
            return response()->json([
                'success' => true,
                'action' => 'removed',
                'message' => 'Book removed from wishlist!'
            ]);
        } else {
            // Add to wishlist
            WishListItem::create([
                'wish_list_id' => $defaultWishlist->wish_list_id,
                'book_id' => $request->book_id,
                'date_added' => Carbon::now()
            ]);

            return response()->json([
                'success' => true,
                'action' => 'added',
                'message' => 'Book added to wishlist!'
            ]);
        }
    }

    // Get user's wishlists for dropdown
    public function getUserWishlists()
    {
        $wishlists = WishList::where('user_id', Auth::id())
            ->select('wish_list_id', 'name')
            ->orderBy('name')
            ->get();

        return response()->json($wishlists);
    }

    // Check if book is in any wishlist
    public function checkBookInWishlist($bookId)
    {
        $isInWishlist = WishListItem::whereIn('wish_list_id', function ($query) {
            $query->select('wish_list_id')
                ->from('wish_list')
                ->where('user_id', Auth::id());
        })
            ->where('book_id', $bookId)
            ->exists();

        return response()->json(['in_wishlist' => $isInWishlist]);
    }

    // View public wishlist (for sharing)
    public function viewPublic($wishListId)
    {
        $wishlist = WishList::where('wish_list_id', $wishListId)
            ->where('is_public', 1)
            ->with(['wishlistItems.book', 'user'])
            ->firstOrFail();

        return view('wishlists.public', compact('wishlist'));
    }
}
