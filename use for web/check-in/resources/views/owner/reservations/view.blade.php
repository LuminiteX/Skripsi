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
                    <div class="space-y-8 divide-y divide-gray-200 w-full max-w-lg mx-auto">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-owner-layout>
