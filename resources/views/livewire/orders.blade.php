<div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="gap-7">
                    <th>#</th>
                    <th>Name </th>
                    <th>Pickup Location</th>
                    <th>Delivery Location</th>
                    <th>Status </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($bookings as $booking)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->pickup_location }}</td>
                        <td>{{ $booking->delivery_location }}</td>
                        <td>
                            <a href="/orders/edit/{{ $booking->id }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                {{ $booking->status }} (Accept)
                            </a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
