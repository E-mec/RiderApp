<x-layouts.app :title="__('Dashboard')">
    {{-- <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div>
    </div> --}}

    <div class="text-center">
        <h1 class="text-3xl font-bold mb-8">
            Your Orders
        </h1>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Pickup Location
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Delivery Location
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">

                        </th>
                        <th scope="col" class="px-6 py-3">
                            Rating
                        </th>
                    </tr>
                </thead>
                <tbody>


                    @forelse ($bookings as $booking)
                        <tr>
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">{{ $booking->pickup_location }}</td>
                            <td class="px-6 py-4">{{ $booking->delivery_location }}</td>
                            <td class="px-6 py-4">
                                {{ $booking->status === 'accepted' ? 'In Transit' : $booking->status }}

                            </td>

                            <td class="px-6 py-4">
                                @if ($booking->status === 'accepted')
                                    <form action="{{ route('bookings.complete', $booking->id) }}" method="POST"
                                        class="ml-3">
                                        @csrf
                                        <button type="submit"  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            I've Received My Delivery
                                        </button>
                                    </form>
                                @endif
                            </td>

                            <td>
                                @if ($booking->status === 'completed')
                                    <livewire:rating-form :booking="$booking" :ratee-id="$booking->rider_id" :key="'rating-' . $booking->id" />
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="-1">No orders found</td>
                        </tr>
                    @endforelse


                </tbody>
            </table>
        </div>


    </div>
</x-layouts.app>
