<x-owner-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (auth()->user()->has_restaurant == 1)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="m-2 p-2 bg-slate-100 rounded">
                    <div class="space-y-8 divide-y divide-gray-200 mt-10 mx-1">
                        <div class="container mx-auto lg:flex lg:flex-row">
                            <div class="w-full lg:w-1/2 flex items-center justify-center mb-10">
                                @if ($restaurant->image)
                                    <div class="w-full h-64 px-4">
                                        <img class="object-cover w-full h-full"
                                            src="{{ Storage::url($restaurant->image) }}" alt="Restaurant image">
                                    </div>
                                @else
                                    <img class="max-h-64" src="{{ asset('storage/default/default-image.jpg') }}"
                                        alt="Default image">
                                @endif
                            </div>
                            <div class="w-full lg:w-1/2 lg:ml-5 px-2">
                                <h2 class="text-xl font-bold mb-2 border-b-2 border-gray-200 pb-2">
                                    Restaurant Name
                                </h2>
                                <p class="text-gray-600 mb-2">
                                    {{ $restaurant->name }}
                                </p>
                                <h2 class="text-xl font-bold mb-2 border-b-2 border-gray-200 pb-2">
                                    Restaurant Description
                                </h2>
                                <p class="text-gray-600 mb-2">
                                    {{ $restaurant->description }}
                                </p>
                                <h2 class="text-xl font-bold mb-2 border-b-2 border-gray-200 pb-2">
                                    Restaurant Phone Number
                                </h2>
                                <p class="text-gray-600 mb-2">
                                    {{ $restaurant->phone_number }}
                                </p>
                                <h2 class="text-xl font-bold mb-2 border-b-2 border-gray-200 pb-2">
                                    Restaurant Address
                                </h2>
                                <p class="text-gray-600 mb-2">
                                    {{ $restaurant->address }}
                                </p>
                                <h2 class="text-xl font-bold mb-2 border-b-2 border-gray-200 pb-2">
                                    Restaurant Opening Time
                                </h2>
                                <p class="text-gray-600 mb-2">
                                    Opening Time:
                                    {{ $formattedTimeOpening }}
                                </p>
                                <h2 class="text-xl font-bold mb-2 border-b-2 border-gray-200 pb-2">
                                    Restaurant Closing Time
                                </h2>
                                <p class="text-gray-600 mb-2">
                                    Closing Time: {{ $formattedTimeClosing }}
                                </p>
                                <h2 class="text-xl font-bold mb-2 border-b-2 border-gray-200 pb-2">
                                    Restaurant Status
                                </h2>
                                <p class="text-gray-600 mb-2">Status:
                                    @if ($restaurant->restaurant_status == 0)
                                        Not eligible
                                    @endif
                                    @if ($restaurant->restaurant_status == 1)
                                        Eligible
                                    @endif
                                </p>
                                <h2 class="text-xl font-bold mb-2 border-b-2 border-gray-200 pb-2">
                                    Restaurant Opening Status
                                </h2>
                                <p class="text-gray-600 mb-2">Opening Status:
                                    @if ($restaurant->restaurant_opening_status == 0)
                                        Closed
                                    @endif
                                    @if ($restaurant->restaurant_opening_status == 1)
                                        Open
                                    @endif
                                </p>
                                <div class="flex sm:justify-center md:justify-start mt-8 space-x-10">
                                    {{-- example {{ route('restaurants.edit', $restaurant->id) }} --}}
                                    <a href="{{ route('owner.restaurant.profile.activate') }}"
                                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded s">Open</a>
                                    <a href="{{ route('owner.restaurant.profile.deactivate') }}"
                                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Close</a>
                                    <a href="{{ route('owner.restaurant.profile.edit.show') }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-owner-layout>
