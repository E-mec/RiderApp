<?php

namespace App\Livewire;

use App\Models\Rating;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class RatingForm extends Component
{
    public $booking;
    public $rateeId;
    public $rating = null;
    public $comment = '';
    public $hasRated = false;

    public function mount($booking, $rateeId)
    {
        $this->booking = $booking;
        $this->rateeId = $rateeId;

        $this->hasRated = Rating::where('booking_id', $this->booking->id)
            ->where('rater_id', Auth::id())
            ->exists();
    }

    public function submit()
    {
        $this->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string',
        ]);

        Rating::create([
            'booking_id' => $this->booking->id,
            'rater_id' => Auth::id(),
            'ratee_id' => $this->rateeId,
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);

        $this->hasRated = true;
        $this->reset('rating', 'comment');
    }
    public function render()
    {
        return view('livewire.rating-form');
    }
}
