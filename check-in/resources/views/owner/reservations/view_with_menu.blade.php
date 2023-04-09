<x-owner-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (auth()->user()->has_restaurant == 1)
        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                <div class="flex m-2 p-2">
                    <a href="{{ route('owner.reservations.index') }}"
                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Table Reservation
                        Index</a>
                </div>
                <div class="m-2 p-2 bg-slate-100 rounded">
                    <div class="space-y-8 divide-y divide-gray-200 w-full max-w-3xl mx-auto">
                        <div class="px-6 py-8 bg-white shadow rounded-lg">
                            <h2 class="text-lg font-bold mb-4 text-gray-800 border-b">Reservation Detail</h2>

                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-md font-medium text-gray-500">Customer Full Name</h3>
                                    <p class="text-md font-medium text-gray-800">{{ $reservation->user->name }}</p>
                                </div>

                                <div class="flex items-center justify-between">
                                    <h3 class="text-md font-medium text-gray-500">Reservation Date</h3>
                                    <p class="text-md font-medium text-gray-800">
                                        {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d F Y') }}</p>

                                </div>

                                <div class="flex items-center justify-between">
                                    <h3 class="text-md font-medium text-gray-500">Reservation Time</h3>
                                    <p class="text-md font-medium text-gray-800">
                                        {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('H:i a') }}</p>
                                </div>

                                <div class="flex items-center justify-between">
                                    <h3 class="text-md font-medium text-gray-500">Guest Number</h3>
                                    <p class="text-md font-medium text-gray-800">{{ $reservation->guest_number }}</p>
                                </div>

                                <div class="flex items-center justify-between">
                                    <h3 class="text-md font-medium text-gray-500">Table Name</h3>
                                    <p class="text-md font-medium text-gray-800">{{ $reservation->table->name }}</p>
                                </div>

                                <div class="flex items-center justify-between">
                                    <h3 class="text-md font-medium text-gray-500">Customer Phone Number</h3>
                                    <p class="text-md font-medium text-gray-800">{{ $reservation->user->phone_number }}
                                    </p>
                                </div>

                                <div class="flex items-center justify-between">
                                    <h3 class="text-md font-medium text-gray-500">Customer Email</h3>
                                    <p class="text-md font-medium text-gray-800">{{ $reservation->user->email }}</p>
                                </div>

                                <div class="container mx-auto mt-10">
                                    <h2 class="text-lg font-bold mb-2">Cart Items</h2>

                                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                                        Image
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                                        Name
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                                        Price
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                                        Quantity
                                                    </th>
                                                    <th scope="col"
                                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                                        Subtotal
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach ($reservation->cart_header->cart_detail as $item)
                                                    <tr>
                                                        <td
                                                            class="px-6 py-4 whitespace-nowrap text-center flex items-center justify-center">
                                                            <img class="h-8 w-8 rounded-full object-cover"
                                                                src="{{ Storage::url($item->menu->image) }}"
                                                                alt="{{ $item->menu->name }}">
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $item->menu->name }}</div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                                            <div class="text-sm text-gray-500">
                                                                {{ 'Rp ' . number_format($item->menu->price, 0, ',', '.') }}
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                                            <div class="text-sm text-gray-500">{{ $item->quantity }}
                                                            </div>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                                            <div class="text-sm text-gray-500">
                                                                {{ 'Rp ' . number_format($item->subtotal, 0, ',', '.') }}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="4"
                                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        Total
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                        {{ 'Rp ' . number_format($reservation->cart_header->total, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <h2 class="text-lg font-bold mb-2">Proof of transaction</h2>

                                @if ($reservation->cart_header->image)
                                    <div>
                                        <img class="w-2/4 h-3/5"
                                            src="{{ Storage::url($reservation->cart_header->image) }}">
                                    </div>
                                @else
                                    <div class="mt-1">
                                        <input type="file" id="image" name="image" disabled
                                            class="block w-full appearance-none bg-gray-100 border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                            readonly />
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-owner-layout>
