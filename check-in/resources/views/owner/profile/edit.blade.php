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
                    <a href="{{ route('owner.profile') }}"
                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Owner Profile</a>
                </div>
                <div class="m-2 p-2 bg-slate-100 rounded">
                    <div class="space-y-8 divide-y divide-gray-200 sm:mx-10 md:w-1/2 md:mx-52">
                        <h1 class="text-center font-bold text-2xl">Edit Owner</h1>
                        <form method="POST" action="{{ route('owner.profile.edit.save') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Name -->
                            <div>
                                <x-label for="name" :value="__('Name')" />
                                <div class="mt-1">
                                    <input type="text" id="name" name="name"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                        value="{{ $user->name }}" />
                                </div>
                                @error('name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <x-label for="phone_number" :value="__('Phone Number')" />
                                <p class="text-gray-500 text-xs">
                                    please input the phone format like the example +6281234567890
                                </p>
                                <x-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number"
                                    :value="$user->phone_number" required />
                                @error('phone_number')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <x-label for="address"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    :value="__('Address')" />
                                <textarea id="address" rows="4" name="address"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Write Address...">{{ $user->address }}</textarea>

                                @error('address')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mt-1">
                                <x-label for="image"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    :value="__('User Profile Picture')" />
                                <div>
                                    <img class="w-32 h-32" src="{{ Storage::url($user->image) }}">
                                </div>
                                <input type="file" id="image" name="image"
                                    class="block w-full mt-2 appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
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
    @endif
</x-owner-layout>
