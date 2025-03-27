<?php

use App\Http\Controllers\Admin\ContentBlockController;
use App\Http\Controllers\BuyTickets;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('main');
})->name('main');

Route::get('/afisha', function () {
    return view('afisha');
})->name('afisha');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contacts', function () {
    return view('contacts');
})->name('contacts');

Route::get('/buy-tickets', [BuyTickets::class, 'index'])->name('buy-tickets');

Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');

Route::get('/afisha/{id}', function ($id) {
    return view('detail-afisha', ['event_id' => $id]);
})->name('detailed-afisha');

Route::post('/reviews/add', [ReviewController::class, 'add'])->name('reviews.add');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/reviews', function () {
    return view('admin.reviews');
})->middleware(['auth', 'verified'])->name('admin.reviews');


Route::prefix('admin/reviews')->middleware(['auth'])->group(function () {
    Route::post('/{review}/approve', [ReviewController::class, 'approve'])->name('reviews.approve');
    Route::delete('/{review}/reject', [ReviewController::class, 'reject'])->name('reviews.reject');
});

Route::resource('events', EventController::class)
    ->middleware(['auth', 'verified'])
    ->except(['show']);

Route::resource('galleries', GalleryController::class)
    ->middleware(['auth', 'verified'])
    ->except(['show']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin/content')->middleware(['auth'])->group(function () {
    Route::get('/', [ContentBlockController::class, 'index'])->name('admin.content.index');
    Route::get('/{contentBlock}/edit', [ContentBlockController::class, 'edit'])->name('admin.content.edit');
    Route::put('/{contentBlock}', [ContentBlockController::class, 'update'])->name('admin.content.update');
});

require __DIR__ . '/auth.php';
