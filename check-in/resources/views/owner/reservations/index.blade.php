<x-owner-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (auth()->user()->has_restaurant == 1)

        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8 md:max-w-7xl">
                <div class="relative">
                    <div class="bg-white flex items-center">
                        <div class="inline-block relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="focus:outline-none shadow cursor-pointer  text-gray-700 hover:text-black flex border border-gray-400 rounded p-2 pr-1 bg-gray-100"
                                :class="{ 'shadow-none border-indigo-300': open }">
                                Sort By
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    :class="{ 'rotate-180': open }"
                                    class="ml-1 transform duration-300 inline-block fill-current text-gray-500 w-6 h-6">
                                    <path fill-rule="evenodd"
                                        d="M15.3 10.3a1 1 0 011.4 1.4l-4 4a1 1 0 01-1.4 0l-4-4a1 1 0 011.4-1.4l3.3 3.29 3.3-3.3z" />
                                </svg>
                            </button>

                            <ul x-show="open"
                                class="bg-white absolute left-0 shadow w-80 rounded text-indigo-600 origin-top"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform scale-y-50"
                                x-transition:enter-end="opacity-100 transform scale-y-100"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-end="opacity-0 transform scale-y-50">
                                <li><a href="{{ route('owner.reservations.sort_by_date_desc') }}"
                                        class="py-1 px-3 border-b block hover:bg-indigo-100">Reservation
                                        date descending order</a>
                                </li>
                                <li><a href="{{ route('owner.reservations.sort_by_status') }}"
                                        class="py-1 px-3 border-b block hover:bg-indigo-100">Sort by
                                        status</a>
                                </li>
                                <li><a href="{{ route('owner.reservations.sort_by_date_now') }}"
                                        class="py-1 px-3 border-b block hover:bg-indigo-100">Sort by date
                                        from now until the future</a>
                                </li>
                                <li><a href="{{ route('owner.reservations.sort_by_guest_number') }}"
                                        class="py-1 px-3 block hover:bg-indigo-100">Sort by guest
                                        number</a></li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="flex flex-col">
                    <div class="overflow-x-auto md:overflow-x-visible sm:-mx-6 lg:-mx-8">
                        <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden shadow-md sm:rounded-lg md:overflow-visible">
                                <table class="min-w-full">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col"
                                                class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Name
                                            </th>
                                            <th scope="col"
                                                class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Date
                                            </th>
                                            <th scope="col"
                                                class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Time
                                            </th>
                                            <th scope="col"
                                                class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Email
                                            </th>
                                            <th scope="col"
                                                class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Phone Number
                                            </th>
                                            <th scope="col"
                                                class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Table
                                            </th>
                                            <th scope="col"
                                                class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Guests
                                            </th>
                                            <th scope="col"
                                                class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Menu
                                            </th>
                                            <th scope="col"
                                                class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Status
                                            </th>
                                            <th scope="col" class="relative py-3 px-6">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reservations as $reservation)
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <td
                                                    class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $reservation->user->name }} {{ $reservation->last_name }}
                                                </td>
                                                <td
                                                    class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d F Y') }}
                                                </td>
                                                <td
                                                    class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('H:i') }}
                                                </td>
                                                <td
                                                    class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                    {{ $reservation->user->email }}
                                                </td>
                                                <td
                                                    class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                    {{ $reservation->user->phone_number }}
                                                </td>
                                                <td
                                                    class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                    {{ $reservation->table->name }}
                                                </td>
                                                <td
                                                    class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                    {{ $reservation->guest_number }}
                                                </td>
                                                <td
                                                    class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                    @if ($reservation->cart_header)
                                                        Yes
                                                    @else
                                                        No
                                                    @endif
                                                </td>
                                                <td
                                                    class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                    @if ($reservation->reservation_status == 0)
                                                        Not Yet
                                                    @elseif ($reservation->reservation_status == 1)
                                                        Waiting for receipt
                                                    @elseif ($reservation->reservation_status == 2)
                                                        Reservation being checked
                                                    @elseif ($reservation->reservation_status == 3)
                                                        Eligible
                                                    @elseif ($reservation->reservation_status == 4)
                                                        Finished
                                                    @elseif ($reservation->reservation_status == 5)
                                                        Finished
                                                    @else
                                                        Rejected
                                                    @endif

                                                </td>
                                                <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">
                                                    <div class="flex space-x-2">
                                                        @if ($reservation->reservation_status == 0)
                                                            <a href="{{ route('owner.reservations.reject', $reservation->id) }}"
                                                                class="px-4 py-2 mr-6 bg-red-500 hover:bg-red-700 rounded-lg text-white">Rejected</a>
                                                        @elseif ($reservation->reservation_status == 1)
                                                            <a href="{{ route('owner.reservations.show', $reservation->id) }}"
                                                                class="px-4 py-2 bg-blue-500 hover:bg-blue-700 rounded-lg  text-white">View</a>
                                                            <form
                                                                class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                                                method="POST"
                                                                action="{{ route('owner.reservations.reject', $reservation->id) }}"
                                                                onsubmit="return confirm('Are you sure you want to reject this reservation?');">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit">Rejected</button>
                                                            </form>
                                                        @elseif ($reservation->reservation_status == 2)
                                                            <a href="{{ route('owner.reservations.show', $reservation->id) }}"
                                                                class="px-4 py-2 bg-blue-500 hover:bg-blue-700 rounded-lg  text-white">View</a>
                                                            <a href="{{ route('owner.reservations.edit', $reservation->id) }}"
                                                                class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg  text-white">Update
                                                                Status</a>
                                                            @if ($reservation->cart_header)
                                                                <form
                                                                    class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                                                    method="POST"
                                                                    action="{{ route('owner.reservations.reject', $reservation->id) }}"
                                                                    onsubmit="return confirm('Are you sure you want to reject this reservation?');">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit">Rejected</button>
                                                                </form>
                                                            @endif
                                                        @elseif ($reservation->reservation_status == 3)
                                                            <a href="{{ route('owner.reservations.show', $reservation->id) }}"
                                                                class="px-4 py-2 bg-blue-500 hover:bg-blue-700 rounded-lg  text-white">View</a>
                                                            <a href="{{ route('owner.reservations.finish', $reservation->id) }}"
                                                                class="px-4 py-2 bg-blue-500 hover:bg-blue-700 rounded-lg  text-white">Finish</a>
                                                        @elseif ($reservation->reservation_status == 4)
                                                            <a href="{{ route('owner.reservations.show', $reservation->id) }}"
                                                                class="px-4 py-2 bg-blue-500 hover:bg-blue-700 rounded-lg  text-white">View</a>
                                                        @elseif ($reservation->reservation_status == 5)
                                                            <a href="{{ route('owner.reservations.show', $reservation->id) }}"
                                                                class="px-4 py-2 bg-blue-500 hover:bg-blue-700 rounded-lg  text-white">View</a>
                                                        @else
                                                            <a href="{{ route('owner.reservations.show', $reservation->id) }}"
                                                                class="px-4 py-2 bg-blue-500 hover:bg-blue-700 rounded-lg  text-white">View</a>
                                                        @endif

                                                        {{-- <a href="{{ route('owner.reservations.edit', $reservation->id) }}"
                                                            class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-lg  text-white">Edit</a>
                                                        <form
                                                            class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded-lg text-white"
                                                            method="POST"
                                                            action="{{ route('owner.reservations.edit', $reservation->id) }}"
                                                            onsubmit="return confirm('Are you sure?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit">Delete</button>
                                                        </form> --}}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center my-4">
                        {{ $reservations->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-owner-layout>
