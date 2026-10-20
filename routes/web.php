<?php

use App\Http\Controllers\ApiTokenController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SsoController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionNameController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Auth;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;

if (app()->isLocal()) {
    Route::get('/mail-test', function () {
        $email = request('email', 'test@example.com');
        Mail::to($email)->send(new TestMail(recipientName: $email));
        return "Test email sent to {$email}";
    });
}

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('landing');
});

// SSO: login, register, reset password, dan verifikasi email ditangani hub (config/sso.php)
Route::get('/login', [SsoController::class, 'login'])->name('login');
Route::get('/register', [SsoController::class, 'register'])->name('register');
Route::get('/forget-password', [SsoController::class, 'forgotPassword'])->name('password.request');
Route::get('/email/verify', [SsoController::class, 'verifyEmail'])->middleware('auth')->name('verification.notice');
Route::get('/logout', [SsoController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'app.access', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/wallets', [DashboardController::class, 'walletsPage'])->name('dashboard.wallets');
    Route::post('/dashboard/transactions', [DashboardController::class, 'transactionsPage'])->name('dashboard.transactions');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/profile/api-token/generate', [ApiTokenController::class, 'generate'])->name('api-token.generate');
    Route::post('/profile/api-token/reset', [ApiTokenController::class, 'reset'])->name('api-token.reset');
    Route::delete('/profile/api-token', [ApiTokenController::class, 'revoke'])->name('api-token.revoke');

    // User, role, dan permission money dikelola terpusat di hub (auth.elips.id)
    Route::get('/access', [SsoController::class, 'manageAccess'])->name('access.manage');
    Route::resource('menus', MenuController::class)->except(['show']);

    // Finance
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('transaction-names', TransactionNameController::class)->except(['show']);
    Route::resource('wallets', WalletController::class)->except(['show']);
    Route::resource('transactions', TransactionController::class)->except(['show']);

    // Feedback
    Route::resource('feedbacks', FeedbackController::class)->except(['edit']);

    Route::get('/stock',[StockController::class,'index'])->name('stock');
});