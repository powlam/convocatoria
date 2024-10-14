<?php

use App\Http\Controllers\MeetingController;
use App\Models\Meeting;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('meet/{meeting:slug}', function (Meeting $meeting) {
    return view('meeting', compact('meeting'));
})->name('meeting');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')
        ->name('dashboard');

    Route::resource('meetings', MeetingController::class)->except(['index', 'show']);
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
