<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NomineeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
//Route::middleware(['check.voting'])->group(function () {
    Route::get('category/{id}', [HomeController::class, 'showCategory'])->name('category.show');
//});
Route::post('vote/{nominee}/{category}', [VoteController::class, 'store'])->name('vote');

Route::middleware(['check.declare_winner'])->group(function ()  {
    Route::get('winners', [HomeController::class, 'showWinners'])->name('winners');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('home');
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('profile/update', [AdminController::class, 'updateProfile'])->name('profile.update');
    Route::put('profile/password', [AdminController::class, 'updatePassword'])->name('profile.password');

    // Categories
    Route::resource('categories', CategoryController::class)->except(['show']);
    // Nominees
    Route::resource('nominees', NomineeController::class)->except(['show']);
    // Settings
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

    Route::get('votes', [VoteController::class, 'showVotes'])->name('votes.index');
    Route::post('votes/reset', [VoteController::class, 'resetVotes'])->name('votes.reset');

    Route::get('winners', [VoteController::class, 'showWinners'])->name('winners.index');


});

Route::get('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('applogout');

require __DIR__.'/auth.php';
