<x-customer-layout>
    <div class="container">
        <div class="row mb-3 mt-3">
            <a href="{{ route('reservations.list') }}" class="btn btn-primary" style="width: 183px">Back</a>
        </div>
            <div class="row mb-2 mt-3">
                <h2>Reservation Detail</h2>
                <hr class="border-dark" style="width: 25%">
            </div>
            <div class="row mb-2">
                <h2 class="mb-4"><strong>Full Name:</strong> {{ $reservations->user->name }}</h2>
                <h2 class="mb-4"><strong>Restaurant Name:</strong> {{ $reservations->restaurant->name }}</h2>
                <h2 class="mb-4"><strong>Reservation Date:</strong> {{ \Carbon\Carbon::parse($reservations->reservation_date)->format('d F Y') }}</h2>
                <h2 class="mb-4"><strong>Reservation Time:</strong> {{ \Carbon\Carbon::parse($reservations->reservation_date)->format('H:i a') }}</h2>
                <h2 class="mb-4"><strong>Guest Number:</strong> {{ $reservations->guest_number }}</h2>
                <h2 class="mb-4"><strong>Table Number:</strong> {{ $reservations->table->name }}</h2>
                <h2 class="mb-4"><strong>Restaurant Address</strong></h2>
                <h3 class="mb-4">{{ $reservations->restaurant->address }}</h3>
            </div>
    </div>
</x-customer-layout>
