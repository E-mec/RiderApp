<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Component;

class Orders extends Component
{

    public $bookings; 

    public function mount()
    {
        $this->bookings = Booking::latest()->with('user')->where('status', 'pending')->whereNull('rider_id')->get();
    }

    public function render()
    {
        return view('livewire.orders');
    }
}
