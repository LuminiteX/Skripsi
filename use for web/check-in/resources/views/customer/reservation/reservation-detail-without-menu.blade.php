<x-customer-layout>
    <div class="container ">
        <div class="row mb-3 mt-3">
            <a href="{{ route('reservations.list') }}" class="btn btn-primary btn-lg mt-5 mb-1"
                style="width: 183px">Back</a>
        </div>
        <div class="row mb-2 mt-3">
            <div class="col card-header">
                <h2>Reservation Detail</h2>
            </div>
        </div>
        <div class="card-body w-100 p-0">
            <div class="row mb-2">
                <div class="col-md-12">
                    <h2 class="mb-4"><strong>Full Name:</strong> {{ $reservations->user->name }}</h2>
                    <h2 class="mb-4"><strong>Restaurant Name:</strong> {{ $reservations->restaurant->name }}</h2>
                    <h2 class="mb-4"><strong>Reservation Date:</strong>
                        {{ \Carbon\Carbon::parse($reservations->reservation_date)->format('d F Y') }}</h2>
                    <h2 class="mb-4"><strong>Reservation Time:</strong>
                        {{ \Carbon\Carbon::parse($reservations->reservation_date)->format('H:i a') }}</h2>
                    <h2 class="mb-4"><strong>Guest Number:</strong> {{ $reservations->guest_number }}</h2>
                    <h2 class="mb-4"><strong>Table Number:</strong> {{ $reservations->table->name }}</h2>
                </div>
                <div class="col-md-6">
                    <h2 class="mb-4"><strong>Restaurant Address</strong></h2>
                    <h3 class="mb-4">{{ $reservations->restaurant->address }}</h3>
                </div>
            </div>
        </div>
    </div>
</x-customer-layout>
