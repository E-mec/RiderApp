<div>
    <form wire:submit="accept">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold">Profile</h2>
                

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="username" class="block text-sm/6 font-medium">Name</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                
                                <input type="text" wire:model="name" id="username"
                                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                    placeholder="" readonly>
                            </div>

                            
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="username" class="block text-sm/6 font-medium">Pickup Location</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                
                                <input type="text" wire:model="pickup_location" id="pickup"
                                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                    placeholder="" readonly>
                            </div>

                            
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="username" class="block text-sm/6 font-medium">Destination</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                
                                <input type="text" wire:model="delivery_location" id="delivery"
                                    class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                    placeholder="" readonly>
                            </div>

                            
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="country" class="block text-sm/6 font-medium">Status</label>
                        <div class="mt-2 grid grid-cols-1">
                          <select id="status" wire:model="status" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option>Pending</option>
                            <option>In Transit</option>
                            <option>Completed</option>
                          </select>
                          <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                          </svg>
                        </div>
                      </div>

                </div>
            </div>

            
        </div>

        <div id="map" class="w-full h-96 my-4 rounded shadow" style="height: 400px; width: 100%;"></div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
            <button type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Accept</button>
        </div>
    </form>

    

</div>

@assets
<!-- Leaflet assets -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.min.js"></script>
@endassets

@script
<script>
    document.addEventListener('livewire:navigated', function () {
        // alert('working here');
        const pickup = L.latLng({{ $booking->pickup_lat }}, {{ $booking->pickup_lng }});
        const dropoff = L.latLng({{ $booking->dropoff_lat }}, {{ $booking->dropoff_lng }});

        const map = L.map('map').setView(pickup, 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        L.Routing.control({
            waypoints: [pickup, dropoff],
            lineOptions: {
                styles: [{ color: 'blue', opacity: 0.7, weight: 3 }]
            },
            createMarker: function (i, waypoint, n) {
                const labels = ['📦 Pickup', '🎯 Dropoff'];
                return L.marker(waypoint.latLng).bindPopup(labels[i]).openPopup();
            },
            routeWhileDragging: false
        }).addTo(map);
    });
</script>
@endscript




