<?php

namespace App\Livewire\Booking;

use App\Models\Booking;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CreateBooking extends Component
{
    public $pickup_location = '';
    public $delivery_location = '';


    protected $rules = [
        'pickup_location' => 'required|string',
        'delivery_location' => 'required|string',
    ];

    public function save()
    {
        $this->validate();

        $pickup = $this->geocodeAddress($this->pickup_location);
        $dropoff = $this->geocodeAddress($this->delivery_location);

        if (!$pickup || !$dropoff) {

            dd("Not working");
            $this->addError('pickup_address', 'Could not find coordinates for the address.');
            return;
        }


        Booking::create([
            'user_id' => auth()->id(),
            'pickup_location' => $this->pickup_location,
            'delivery_location' => $this->delivery_location,
            'pickup_lat' => $pickup['lat'],
            'pickup_lng' => $pickup['lng'],
            'dropoff_lat' => $dropoff['lat'],
            'dropoff_lng' => $dropoff['lng']
        ]);

        $this->reset(['pickup_location', 'delivery_location']);

        return redirect()->route('dashboard');
    }

    private function geocodeAddress($address)
    {
        $res = Http::get('https://api.opencagedata.com/geocode/v1/json', [
            'key' => env('OPENCAGE_KEY'),
            'q' => $address,
            'limit' => 1
        ]);

        if ($res->ok() && count($res['results']) > 0) {
            return $res['results'][0]['geometry'];
        }

        return null;
    }

    public function render()
    {
        return view('livewire.booking.create-booking');
    }
}
