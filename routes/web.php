<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminRController;
use App\Http\Controllers\UserPrefrenceController;
use App\Http\Controllers\Admin\AdminAccountController;
use App\Http\Controllers\Auth\PasswordResetController;



Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('books', BookController::class);
    Route::get('admin-profile', [AdminAccountController::class, 'adminProfile'])->name('admin.profile');
    Route::get('/book/detail/{id}', [AdminController::class, 'BookDetail'])->name('book.detail');



    Route::post('update-admin-profile', [AdminAccountController::class, 'AdminProfileUpdate'])->name('admin.update.profile');
    Route::get('admin/reviews', [AdminRController::class, 'index'])->name('admin.reviews');
    Route::post('admin/delete-review', [AdminRController::class, 'deleteUserReview'])->name('admin.admin.deleteReview');



    Route::get('/reports', [ReportController::class, 'showReports'])->name('reports');

    Route::post('/reports/action', [ReportController::class, 'handleReportAction'])->name('reports.action');
});

Route::middleware('web')->group(function () {
    Route::prefix('account')->group(function () {

        Route::group(['middleware' => 'guest'], function () {
            Route::get('register', [AccountController::class, 'register'])->name('account.register');
            Route::get('login', [AccountController::class, 'login'])->name('account.login');
            Route::post('register', [AccountController::class, 'processRegister'])->name('account.processRegister');
            Route::post('login', [AccountController::class, 'authenticate'])->name('account.authenticate');
        });

        Route::group(['middleware' => 'auth'], function () {
            Route::get('/', [HomeController::class, 'index'])->name('home');
            Route::get('/book/{id}', [HomeController::class, 'detail'])->name('book.detail');
            Route::get('profile', [AccountController::class, 'profile'])->name('account.profile');
            Route::get('logout', [AccountController::class, 'logout'])->name('account.logout');
            Route::post('update-profile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');

            Route::get('/about', [AccountController::class, 'about'])->name('about');


            Route::resource('genres', GenreController::class);
            Route::post('/save-book-review', [ReviewController::class, 'saveReview'])->name('book.saveReview');

            Route::get('reviews', [ReviewController::class, 'index'])->name('account.reviews');
            Route::get('reviews/{id}', [ReviewController::class, 'edit'])->name('account.reviews.edit');
            Route::post('reviews/{id}', [ReviewController::class, 'updateReview'])->name('account.reviews.updateReview');
            Route::post('delete-review', [ReviewController::class, 'deleteReview'])->name('account.reviews.deleteReview');

            Route::post('/reviews/{reviewId}/reply', [ReviewController::class, 'storeReply'])->name('account.reviews.reply');
            Route::put('/reviews/reply/{replyId}', [ReviewController::class, 'updateReply'])->name('account.reviews.updateReply');
            Route::post('/reviews/reply/delete', [ReviewController::class, 'deleteReply'])->name('account.reviews.deleteReply');

            Route::post('/report/submit', [ReportController::class, 'submitReport'])->name('account.report.submit');

            Route::get('my-reviews', [AccountController::class, 'myReviews'])->name('account.myReviews');
            Route::get('my-reviews/{id}/edit', [AccountController::class, 'editMyReview'])->name('account.myReviews.edit');
            Route::post('my-reviews/{id}', [AccountController::class, 'updateMyReview'])->name('account.myReviews.update');
            Route::post('delete-my-review', [AccountController::class, 'deleteMyReview'])->name('account.myReviews.delete');
            Route::get('/review/share/{id}', [ReviewController::class, 'share'])->name('review.share');
            Route::get('my-reviews/{id}', [AccountController::class, 'showMyReview'])->name('account.myReviews.show');


            Route::get('/prefrences', [UserPrefrenceController::class, 'index'])->name('prefrences.index');
            Route::post('/prefrences', [UserPrefrenceController::class, 'store'])->name('preferences.store');
            Route::patch('/prefrences/{prefrence_id}/weight', [UserPrefrenceController::class, 'updateWeight'])->name('preferences.updateWeight');
            Route::patch('/prefrences/{prefrence_id}/toggle', [UserPrefrenceController::class, 'toggleActive'])->name('preferences.toggle');
            Route::delete('/prefrences/{prefrence_id}', [UserPrefrenceController::class, 'destroy'])->name('preferences.destroy');
            Route::get('/api/recommendations', [UserPrefrenceController::class, 'getRecommendations'])->name('api.recommendations');

            // Main Wishlist Routes
            Route::prefix('wishlists')->name('account.wishlists.')->group(function () {

                // Display all wishlists
                Route::get('/', [WishListController::class, 'index'])->name('index');

                // Show specific wishlist
                Route::get('/{wishListId}', [WishListController::class, 'show'])->name('show');

                // Create new wishlist
                Route::post('/create', [WishListController::class, 'store'])->name('store');

                // Update wishlist
                Route::put('/{wishListId}', [WishListController::class, 'update'])->name('update');

                // Delete wishlist
                Route::delete('/{wishListId}', [WishListController::class, 'destroy'])->name('destroy');
            });


            Route::prefix('wishlist-items')->name('account.wishlist.items.')->group(function () {
                // Add book to specific wishlist
                Route::post('/add', [WishListController::class, 'addBook'])->name('add');

                Route::post('/remove', [WishListController::class, 'removeBook'])->name('remove');
                // Quick add/remove to default wishlist (for heart button)
                Route::post('/quick-add', [WishListController::class, 'quickAdd'])->name('quickAdd');
            });

            Route::prefix('wishlist-api')->name('account.wishlist.api.')->group(function () {

                // Get user's wishlists for dropdown
                Route::get('/user-wishlists', [WishListController::class, 'getUserWishlists'])->name('getUserWishlists');

                // Check if book is in wishlist
                Route::get('/check-book/{bookId}', [WishListController::class, 'checkBookInWishlist'])->name('checkBook');
            });
        });
    });
});

// Route::get('/test-email', function () {
//     try {
//         $user = App\Models\User::first();

//         if (!$user) {
//             return 'No user found in database';
//         }

//         Mail::to('bc230400840hja@vu.edu.pk')->send(new App\Mail\ReviewReplyNotification($user, 'This is a test reply message'));

//         return 'Email sent successfully!';
//     } catch (Exception $e) {
//         return 'Error: ' . $e->getMessage();
//     }
// });

// Test route for 404 page
Route::get('/test-404', [ErrorController::class, 'test404'])->name('test.404');

// Or direct route
Route::get('/test-404', function () {
    abort(404);
});

// View public wishlist
Route::get('wishlists/public/{wishListId}', [WishListController::class, 'viewPublic'])->name('wishlists.public');


Route::get('/forgot-password', [PasswordResetController::class, 'showForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');

