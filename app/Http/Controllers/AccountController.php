<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;

class AccountController extends Controller
{
    public function register()
    {
        return view('account.register');
    }

    public function processRegister(Request $request)
    {

        // dd(Hash::make($request->password));
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('account.register')->withInput()->withErrors($validator);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('account.login')->with('success', 'You have registered successfully.');
    }

    public function login()
    {
        return view('account.login');
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('account.login')->withInput()->withErrors($validator);
        }

        if (Auth::guard('web')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $user = Auth::user();

            // ✅ Role based redirection
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($user->role === 'user') {
                return redirect()->route('home');
            } else {
                Auth::logout(); // unknown role
                return redirect()->route('account.login')->with('error', 'Unauthorized role.');
            }
        } else {
            return redirect()->route('account.login')->with('error', 'Either email or password is incorrect.');
        }
    }


    public function profile()
    {
        $user = User::find(Auth::user()->user_id);
        return view('account.profile', [
            'user' => $user
        ]);
    }

    public function updateProfile(Request $request)
    {

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:user,email,' . Auth::user()->user_id . ',user_id',

        ];
        if (!empty($request->img)) {
            $rules['img'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('account.profile')->withInput()->withErrors($validator);
        }

        $user = User::find(Auth::user()->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;
        $user->save();
        if (!empty($request->img)) {
            File::delete('uploads/profile/' . $user->img);
            File::delete('uploads/profile/thumb/' . $user->img);
            $img = $request->img;
            $ext = $img->getClientOriginalExtension();
            $imgName = time() . '.' . $ext;
            $img->move(public_path('uploads/profile'), $imgName);
            $user->img = $imgName;
            $user->save();
            $manager = new ImageManager(Driver::class);
            $image = $manager->read(public_path('uploads/profile/' . $imgName));
            $image->cover(150, 150);
            $image->save('uploads/profile/thumb/' . $imgName);
        }
        return redirect()->route('account.profile')->with('success', 'Profile updated successfully.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login');
    }

    public function myReviews()
    {
        $reviews = Review::with('book')
            ->where('user_id', Auth::user()->user_id)
            ->orderBy('created_at', 'DESC')
            ->paginate(2);

        return view('account.my-reviews.my-reviews', compact('reviews'));
    }

    public function editMyReview(Request $request, $id)
    {

        $review = Review::where([
            'review_id' => $id,
            'user_id' => Auth::user()->user_id
        ])->first();
        $books = Book::all();
        return view('account.my-reviews.edit-review', compact('review', 'books'));
    }

    public function updateMyReview($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'review' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
            'book_id' => 'nullable|exists:book,book_id',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('account.myReviews.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }


        $review = Review::findOrFail($id);
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->book_id = $request->book_id;
        $review->save();

        // session()->flash('success', 'Review Updated successfuly.');
        return redirect()->route('account.myReviews')->with('success', 'My review updated successfully.');

        // return redirect()->route('account.reviews')->with('success', 'Review updated successfully.');
    }

    public function deleteMyReview(Request $request)
    {
        $id = $request->review_id;
        $review = Review::find($id);

        if ($review == null) {
            session()->flash('error', 'Review Id not found.');
            return response()->json([
                'status' => false
            ]);
        } else {
            $review->delete();
            session()->flash('success', 'Review deleted successfully.');
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function share($id)
    {
        $review = Review::with('user', 'book')->findOrFail($id);

        return view('account.my_reviews.review_share', compact('review'));
    }


    public function showMyReview($id)
    {
        $review = Review::with('book')->where('user_id', auth::id())->findOrFail($id);
        return view('account.my_reviews.show', compact('review'));
    }

    public function about()
    {
        return view('account.about_us.about');
    }
}
