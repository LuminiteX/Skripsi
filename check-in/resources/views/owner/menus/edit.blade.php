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
                    <a href="{{ route('owner.menus.index') }}"
                        class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Menu Index</a>
                </div>
                <div class="m-2 p-2 bg-slate-100 rounded">
                    <div class="space-y-8 divide-y divide-gray-200 w-full mt-10">
                        <div class="text-center font-bold text-xl">Edit Menu</div>
                        <form method="POST" action="{{ route('owner.menus.update', $menu->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- <input type="hidden" name="restaurant_id" value="{{ $restaurant_id }}" /> --}}

                            <div class="sm:col-span-6">
                                <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                                <div class="mt-1">
                                    <input type="text" id="name" name="name" value="{{ $menu->name }}"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('name')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6 pt-4">
                                <label for="image" class="block text-sm font-medium text-gray-700"> Image </label>
                                <div>
                                    <img class="w-32 h-32" src="{{ Storage::url($menu->image) }}">
                                </div>
                                <div class="mt-1">
                                    <input type="file" id="image" name="image"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('image')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6 pt-5">
                                <label for="price" class="block text-sm font-medium text-gray-700"> Price </label>
                                <p class="text-gray-500 text-xs">
                                    please input the number without "." or "," for example like 100000
                                </p>
                                <div class="mt-1">
                                    <input type="number" min="0.00" max="5000000.00" step="100" id="price"
                                        name="price" value="{{ intval($menu->price) }}"
                                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                </div>
                                @error('price')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="sm:col-span-6 pt-4">
                                <label for="body"
                                    class="block text-sm font-medium text-gray-700">Description</label>
                                <div class="mt-1">
                                    <textarea id="body" rows="3" name="description"
                                        class="shadow-sm focus:ring-indigo-500 appearance-none bg-white border py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ $menu->description }}</textarea>
                                </div>
                                @error('description')
                                    <div class="text-sm text-red-400">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="sm:col-span-6 pt-5">
                                <div class="inline-flex items-center">
                                    <input
                                        class="h-4 w-4 text-primary border-neutral-300 rounded-md checked:bg-primary focus:ring-0 focus:outline-none"
                                        type="checkbox" id="chefRecommendation" name="chefRecommendation" value="1"
                                        {{ $menu->chef_recommendation ? 'checked' : '' }}>
                                    <label class="ml-2 cursor-pointer" for="chefRecommendation">Chef
                                        Recommendation</label>
                                </div>
                            </div>

                            <div class="sm:col-span-6 pt-5">
                                <label for="categories"
                                    class="block text-sm font-medium text-gray-700">Categories</label>
                                <div class="mt-1">
                                    <select id="categories" name="categories[]"
                                        class="form-multiselect block w-full mt-1" multiple>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @selected($menu->categories->contains($category))>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
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
