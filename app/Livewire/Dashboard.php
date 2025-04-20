<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Component;

class Dashboard extends Component
{
    public $bookings;
    public function mount()
    {
        $this->bookings = Booking::where('user_id', auth()->id())->get();

        dd($this->bookings);
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
