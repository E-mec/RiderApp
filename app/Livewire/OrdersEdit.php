<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class OrdersEdit extends Component
{
    public Booking $booking;
    public $name = '';
    public $pickup_location = '';
    public $delivery_location = '';
    public $status = '';

    public function mount(Booking $booking)
    {
        $this->booking = $booking;
        $this->name = $booking->user->name;
        $this->pickup_location = $booking->pickup_location;
        $this->delivery_location = $booking->delivery_location;
        $this->status = $booking->status;
    }

    public function accept()
    {

        $id = $this->booking;

        
        

        if(Auth::user()->rider === 0)
        {
            
            return redirect()->back();
        }

        $id->update([
            'rider_id' => auth()->id(),
            'status' => 'accepted',
        ]);

        return redirect('/orders');
    }
    public function render()
    {
        return view('livewire.orders-edit');
    }
}
