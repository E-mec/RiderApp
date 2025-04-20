<?php

use App\Models\Booking;
use Livewire\Volt\Volt;
use App\Livewire\Orders;
use App\Livewire\Dashboard;
use App\Livewire\OrdersEdit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Livewire\Booking\CreateBooking;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::get('dashboard', function () {

    $bookings = Booking::where('user_id', auth()->id())->get();

    return view('dashboard', [
        'bookings' => $bookings
    ]);
})->name('dashboard');




Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('/booking', CreateBooking::class)->name('booking');

    Route::get('/orders', Orders::class)->name('orders')->can('riders');
    Route::get('/orders/edit/{booking}', OrdersEdit::class)->can('riders');
    Route::post('/bookings/{booking}/complete', function (Request $request, Booking $booking) {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if ($booking->status !== 'accepted') {
            return back()->with('error', 'This booking cannot be marked complete.');
        }

        $booking->update([
            'status' => 'completed'
        ]);

        return back()->with('success', 'Delivery marked as completed!');
    })->name('bookings.complete')->middleware('auth');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
