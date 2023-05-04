<x-owner-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (auth()->user()->has_restaurant == 1)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex m-2 p-2">
                    <a href="{{ route('owner.restaurant.profile') }}"
                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Restaurant Profile</a>
                </div>
                <div class="m-2 p-2 bg-slate-100 rounded">
                    <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10 mx-52">
                        <h1 class="text-center font-bold text-2xl">Edit Restaurant</h1>
                        <form method="POST" action="{{ route('owner.restaurant.profile.edit.save', $restaurant->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="sm:col-span-6">
                                <label for="restaurant_name" class="block text-sm font-medium text-gray-700">Restaurant
                                    Name
                                </label>
                                <div class="mt-1">
                                    <input type="text" id="restaurant_name" name="restaurant_name"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                        value="{{ $restaurant->name }}" />
                                </div>
                                @error('restaurant_name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6 pt-2">
                                <label for="description" class="block text-sm font-medium text-gray-700">
                                    Restaurant Description
                                </label>
                                <div class="mt-1">
                                    <textarea id="description" name="description" rows="4" cols="50"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">{{ $restaurant->description }}</textarea>
                                </div>
                                @error('description')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6 pt-2">
                                <label for="bank_account" class="block text-sm font-medium text-gray-700">
                                    Bank Account
                                </label>
                                <p class="text-gray-500 text-xs">
                                    bank account can be more than one and please input the bank account like BCA :
                                    115165485956
                                </p>
                                <div class="mt-1">
                                    <textarea id="bank_account" name="bank_account" rows="4" cols="50"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">{{ $restaurant->bank_account }}</textarea>
                                </div>
                                @error('bank_account')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6 pt-2">
                                <label for="phone_number" class="block text-sm font-medium text-gray-700">
                                    Restaurant Phone Number
                                </label>
                                <p class="text-gray-500 text-xs">
                                    please input the phone format like the example +6281234567890
                                </p>
                                <div class="mt-1">
                                    <input type="text" id="phone_number" name="phone_number"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                        value="{{ $restaurant->phone_number }}" />
                                </div>
                                @error('phone_number')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6 pt-2">
                                <label for="opening_time" class="block text-sm font-medium text-gray-700">
                                    Restaurant Opening Time
                                </label>
                                <div class="mt-1">
                                    <input type="text" id="timepicker" name="opening_time"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                        value="{{ $restaurant->opening_time }}">
                                </div>
                                @error('opening_time')
                                    <div class="text-sm text-red-400">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6 pt-2">
                                <label for="closing_time" class="block text-sm font-medium text-gray-700">
                                    Restaurant Closing Time
                                </label>
                                <div class="mt-1">
                                    <input type="text" id="timepicker" name="closing_time"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                        value="{{ $restaurant->closing_time }}">
                                </div>
                                @error('closing_time')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6 pt-2">
                                <label for="address" class="block text-sm font-medium text-gray-700">
                                    Restaurant Address
                                </label>
                                <div class="mt-1">
                                    <textarea id="address" name="address" rows="4" cols="50"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5">{{ $restaurant->address }}</textarea>
                                </div>
                                @error('address')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6 pt-2">
                                <label for="image" class="block text-sm font-medium text-gray-700"> Image </label>
                                <div>
                                    <img class="w-32 h-32" src="{{ Storage::url($restaurant->image) }}">
                                </div>
                                <div class="mt-1">
                                    <input type="file" id="image" name="image"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('image')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="flex justify-center items-center h-full pt-6">
                                <button type="submit"
                                    class="px-20 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Edit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            flatpickr("#timepicker", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
            });
        </script>
    @endif

</x-owner-layout>
