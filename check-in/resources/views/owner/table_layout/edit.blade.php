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
                    <a href="{{ route('owner.table_layouts.index') }}"
                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Table Layouts Index</a>
                </div>
                <div class="m-2 p-2 bg-slate-100 rounded">
                    <div class="space-y-8 divide-y divide-gray-200 w-full mt-10">
                        <div class="text-center font-bold text-xl">Edit Table Layout</div>
                        <form method="POST" action="{{ route('owner.table_layouts.update', $table_layout->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="sm:col-span-6">
                                <label for="floor_number" class="block text-sm font-medium text-gray-700"> floor Number
                                </label>
                                <div class="mt-1">
                                    <input type="number" min="0" max="50" step="1" id="floor_number"
                                        name="floor_number"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                        value="{{ $table_layout->floor_number }}" />
                                </div>
                                @error('floor_number')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6 pt-5">
                                <label for="floor_name" class="block text-sm font-medium text-gray-700">Floor Layout
                                    Name
                                </label>
                                <div class="mt-1">
                                    <input type="text" id="floor_name" name="floor_name"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                        value="{{ $table_layout->floor_name }}" />
                                </div>
                                @error('floor_name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6 pt-4">
                                <label for="image" class="block text-sm font-medium text-gray-700"> Image </label>
                                <div>
                                    <img class="w-32 h-32" src="{{ Storage::url($table_layout->floor_image) }}">
                                </div>
                                <div class="mt-1">
                                    <input type="file" id="image" name="image"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('image')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="flex mt-6 p-4 justify-center items-center">
                                <button type="submit"
                                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-owner-layout>
