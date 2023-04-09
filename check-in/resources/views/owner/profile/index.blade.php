<x-owner-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (auth()->user()->has_restaurant == 1)
        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                <div class="m-2 p-2 bg-slate-100 rounded">
                    <div class="space-y-8 divide-y divide-gray-200 mt-10 mx-1">
                        <div class="container mx-auto lg:flex lg:flex-row">
                            <div class="w-full lg:w-1/2 flex items-center justify-center mb-10">
                                @if ($user->image)
                                    <div class="w-full h-80 px-4">
                                        <img class="object-cover w-full h-full" src="{{ Storage::url($user->image) }}"
                                            alt="Restaurant image">
                                    </div>
                                @else
                                    <img class="max-h-64" src="{{ asset('storage/default/default-image.jpg') }}"
                                        alt="Default image">
                                @endif
                            </div>
                            <div class="w-full lg:w-1/2 lg:ml-5 px-2">
                                <h2 class="text-xl font-bold mb-2 border-b-2 border-gray-200 pb-2">
                                    Owner Name
                                </h2>
                                <p class="text-gray-600 mb-2">
                                    {{ $user->name }}
                                </p>
                                <h2 class="text-xl font-bold mb-2 border-b-2 border-gray-200 pb-2">
                                    Owner Email
                                </h2>
                                <p class="text-gray-600 mb-2">
                                    {{ $user->email }}
                                </p>
                                <h2 class="text-xl font-bold mb-2 border-b-2 border-gray-200 pb-2">
                                    Owner Phone Number
                                </h2>
                                <p class="text-gray-600 mb-2">
                                    {{ $user->phone_number }}
                                </p>
                                <h2 class="text-xl font-bold mb-2 border-b-2 border-gray-200 pb-2">
                                    Owner Address
                                </h2>
                                <p class="text-gray-600 mb-2">
                                    {{ $user->address }}
                                </p>

                                <div class="flex sm:justify-center md:justify-start mt-8 space-x-10">
                                    {{-- example {{ route('restaurants.edit', $restaurant->id) }} --}}
                                    <a href="{{ route('owner.profile.edit') }}"
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
