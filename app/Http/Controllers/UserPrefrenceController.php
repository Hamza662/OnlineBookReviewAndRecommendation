<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;
use App\Models\UserPrefrence;
use Illuminate\Support\Facades\Auth;

class UserPrefrenceController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();

        $activePreferences = UserPrefrence::with('genre')
            ->where('user_id', $user_id)
            ->active()
            ->orderBy('preference_weight', 'desc')
            ->get();

        $inactivePreferences = UserPrefrence::with('genre')
            ->where('user_id', $user_id)
            ->inactive()
            ->orderBy('created_date', 'desc')
            ->get();

        $availableGenres = Genre::whereNotIn('genre_id', function ($query) use ($user_id) {
            $query->select('genre_id')
                ->from('user_prefrences')
                ->where('user_id', $user_id);
        })->get();

        return view('prefrence.index', compact(
            'activePreferences',
            'inactivePreferences',
            'availableGenres'
        ));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'genre_id' => 'required|exists:genres,genre_id',
            'preference_weight' => 'required|integer|between:1,10'
        ]);

        $user_id = Auth::id();

        // Check if preference already exists
        $existingPreference = UserPrefrence::where('user_id', $user_id)
            ->where('genre_id', $request->genre_id)
            ->first();

        if ($existingPreference) {
            return back()->with('error', 'This genre preference already exists!');
        }

        UserPrefrence::create([
            'user_id' => $user_id,
            'genre_id' => $request->genre_id,
            'preference_weight' => $request->preference_weight,
            'is_active' => true,
            'created_date' => now()
        ]);

        return back()->with('success', 'Preference added successfully!');
    }

    public function updateWeight(Request $request, $prefrence_id)
    {
        $request->validate([
            'preference_weight' => 'required|integer|between:1,10'
        ]);

        $preference = UserPrefrence::where('prefrence_id', $prefrence_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $preference->update([
            'preference_weight' => $request->preference_weight
        ]);

        return response()->json(['success' => true]);
    }

    public function toggleActive($prefrence_id)
    {

        $preference = UserPrefrence::where('prefrence_id', $prefrence_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $preference->update([
            'is_active' => !$preference->is_active
        ]);

        $status = $preference->is_active ? 'activated' : 'deactivated';
        return back()->with('success', "Preference {$status} successfully!");
    }


    public function destroy($prefrence_id)
    {
        // dd($prefrence_id);
        $preference = UserPrefrence::where('prefrence_id', $prefrence_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $preference->delete();

        return back()->with('success', 'Preference deleted successfully!');
    }

    public function getRecommendations()
    {
        $user_id = Auth::id();

        // STEP 1: User ke favorite genres nikalo
        $userFavoriteGenres = UserPrefrence::where('user_id', $user_id)
            ->where('is_active', 1) 
            ->pluck('genre_id') 
            ->toArray(); 

        // Example: User ne Romance(1), Mystery(5), Adventure(8) choose kiye

        // STEP 2: Check karo ke user ne genres choose kiye hain ya nahi
        if (empty($userFavoriteGenres)) {
            // Agar nahi choose kiye to empty result
            return view('prefrence.book_recommend', [
                'userPreferences' => collect(),
                'recommendedBooks' => collect()
            ]);
        }

        // STEP 3: Un genres ki books dhundo
        $recommendedBooks = Book::whereHas('genres', function ($query) use ($userFavoriteGenres) {
            // Books table mein se wo books lao jinke genres user ke favorites mein hain
            $query->whereIn('genres.genre_id', $userFavoriteGenres);
        })
            ->with('genres') // book ke saath genres bhi load karo
            ->take(20) // sirf 20 books lao
            ->get();

        // STEP 4: User preferences bhi bhejo (display ke liye)
        $userPreferences = UserPrefrence::with('genre')
            ->where('user_id', $user_id)
            ->where('is_active', 1)
            ->get();

        // STEP 5: View ko data bhejo
        return view('prefrence.book_recommend', [
            'userPreferences' => $userPreferences,
            'recommendedBooks' => $recommendedBooks
        ]);
    }

}
