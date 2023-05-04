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
                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Reservation Index</a>
                </div>
                <div class="m-2 p-2 bg-slate-100 rounded">
                    <div class="space-y-8 divide-y divide-gray-200 w-full mt-10">
                        <form method="POST" action="{{ route('owner.reservations.update', $reservation->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="sm:col-span-6">
                                <label for="name" class="block text-sm font-medium text-gray-700"> Name
                                </label>
                                <div class="mt-1">
                                    <input type="text" id="name" name="name"
                                        value="{{ $reservation->user->name }}"
                                        class="block w-full appearance-none bg-gray-200 border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 mb-3"
                                        readonly />
                                </div>
                                @error('name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6">
                                <label for="email" class="block text-sm font-medium text-gray-700"> Email </label>
                                <div class="mt-1">
                                    <input type="email" id="email" name="email"
                                        value="{{ $reservation->user->email }}"
                                        class="block w-full appearance-none bg-gray-200 border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 mb-3"
                                        readonly />
                                </div>
                                @error('email')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6">
                                <label for="phone_number" class="block text-sm font-medium text-gray-700"> Phone number
                                </label>
                                <div class="mt-1">
                                    <input type="text" id="phone_number" name="phone_number"
                                        value="{{ $reservation->user->phone_number }}"
                                        class="block w-full appearance-none bg-gray-200 border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 mb-3"
                                        readonly />
                                </div>
                                @error('phone_number')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6">
                                <label for="reservation_date" class="block text-sm font-medium text-gray-700">
                                    Reservation Date
                                </label>
                                <div class="mt-1">
                                    <input type="datetime-local" id="reservation_date" name="reservation_date"
                                        value="{{ $reservation->reservation_date->format('Y-m-d\TH:i:s') }}"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 mb-3" />
                                </div>
                                @error('reservation_date')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6">
                                <label for="guest_number" class="block text-sm font-medium text-gray-700"> Guest Number
                                </label>
                                <div class="mt-1">
                                    <input type="number" id="guest_number" name="guest_number"
                                        value="{{ $reservation->guest_number }}"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('guest_number')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6 pt-5">
                                <label for="status" class="block text-sm font-medium text-gray-700">Table</label>
                                <div class="mt-1">
                                    <select id="table_id" name="table_id" class="form-multiselect block w-full mt-1">
                                        @foreach ($tables as $table)
                                            <option value="{{ $table->id }}" @selected($table->id == $reservation->table_id)>
                                                {{ $table->name }}
                                                ({{ $table->guest_number }} Guests)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('table_id')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="flex p-1 align-items-center">
                                <div class="flex mt-6 p-3 w-full space-x-48 justify-center">
                                    @if ($reservation->cart_header)
                                        <a href="{{ route('owner.reservations.not_eligible', $reservation->id) }}"
                                            class="px-4 py-2 mr-6 bg-red-500 hover:bg-red-700 rounded-lg text-white">Not
                                            Eligible</a>
                                    @else
                                        <a href="{{ route('owner.reservations.reject', $reservation->id) }}"
                                            class="px-4 py-2 mr-6 bg-red-500 hover:bg-red-700 rounded-lg text-white">Rejected</a>
                                    @endif

                                    <button type="submit"
                                        class="px-4 py-2 ml-6 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Eligible</button>
                                </div>
                            </div>

                    </div>

                    </form>
                </div>

            </div>
        </div>
        </div>
    @endif
</x-owner-layout>
