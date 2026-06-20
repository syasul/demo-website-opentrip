<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminDashboardController;

// Public Pages
Route::get('/', [VisitorController::class, 'index'])->name('home');
Route::get('/explore', [VisitorController::class, 'explore'])->name('explore');
Route::get('/trips/{slug}', [VisitorController::class, 'show'])->name('trips.show');
Route::get('/about', [VisitorController::class, 'about'])->name('about');
Route::get('/contact', [VisitorController::class, 'contact'])->name('contact');
Route::get('/blog', [VisitorController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [VisitorController::class, 'blogDetail'])->name('blog.show');

// Guest Auth Routes
Route::middleware('guest:web')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    // Forgot Password
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendOtpCode'])->name('password.email');
    Route::get('/forgot-password/verify', [AuthController::class, 'showVerifyOtpForm'])->name('password.otp.verify');
    Route::post('/forgot-password/verify', [AuthController::class, 'verifyOtpCode'])->name('password.otp.post');
    Route::get('/forgot-password/reset', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/forgot-password/reset', [AuthController::class, 'resetPassword'])->name('password.update');
});

// Email Verification
Route::get('/email/verify', [AuthController::class, 'showEmailVerificationNotice'])->name('verification.notice');
Route::get('/email/verify/{id}', [AuthController::class, 'verifyEmail'])->name('verification.verify');
Route::post('/email/verification-notification', [AuthController::class, 'resendEmailVerificationNotice'])->name('verification.send');


// Admin Login Route
Route::middleware('guest:admin')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'adminLogin']);
});

// Logout Route (accessible to both)
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

// User Dashboard Panel (Protected by web auth)
Route::middleware('auth:web')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/booking/{slug}', [UserDashboardController::class, 'bookingForm'])->name('user.booking.form');
    Route::post('/booking/{slug}', [UserDashboardController::class, 'storeBooking'])->name('user.booking.store');
    Route::get('/booking/{id}/success', [UserDashboardController::class, 'bookingSuccess'])->name('user.booking.success');
    Route::get('/booking/{id}/invoice', [UserDashboardController::class, 'invoice'])->name('user.invoice');
    Route::post('/booking/{id}/payment', [UserDashboardController::class, 'uploadPayment'])->name('user.payment.upload');
    Route::get('/profile', [UserDashboardController::class, 'profile'])->name('user.profile');
    Route::post('/profile', [UserDashboardController::class, 'updateProfile'])->name('user.profile.update');
    Route::post('/reviews/{trip_id}', [UserDashboardController::class, 'storeReview'])->name('user.review.store');
});

// Admin Panel (Protected by admin auth)
Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Trips
    Route::get('/trips', [AdminDashboardController::class, 'trips'])->name('trips');
    Route::post('/trips', [AdminDashboardController::class, 'storeTrip'])->name('trips.store');
    Route::post('/trips/{id}', [AdminDashboardController::class, 'updateTrip'])->name('trips.update');
    Route::post('/trips/{id}/delete', [AdminDashboardController::class, 'deleteTrip'])->name('trips.delete');
    
    // Bookings
    Route::get('/bookings', [AdminDashboardController::class, 'bookings'])->name('bookings');
    Route::post('/bookings/{id}/verify', [AdminDashboardController::class, 'verifyPayment'])->name('bookings.verify');
    
    // Users
    Route::get('/users', [AdminDashboardController::class, 'users'])->name('users');
    
    // Reviews
    Route::get('/reviews', [AdminDashboardController::class, 'reviews'])->name('reviews');
    Route::post('/reviews/{id}/approve', [AdminDashboardController::class, 'approveReview'])->name('reviews.approve');
    Route::post('/reviews/{id}/reject', [AdminDashboardController::class, 'rejectReview'])->name('reviews.reject');
    
    // Articles
    Route::get('/articles', [AdminDashboardController::class, 'articles'])->name('articles');
    Route::post('/articles', [AdminDashboardController::class, 'storeArticle'])->name('articles.store');
    Route::post('/articles/{id}/delete', [AdminDashboardController::class, 'deleteArticle'])->name('articles.delete');
});
