<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedbackController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [AuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');
Route::get('admin', [FeedbackController::class, 'admin'])->name('adminpanel')->middleware('isAdmin');
Route::get('feedback', [FeedbackController::class, 'feedback'])->name('feedback-page')->middleware('auth');
Route::post('send-feedback', [FeedbackController::class, 'sendFeedback'])->name('send-feedback');