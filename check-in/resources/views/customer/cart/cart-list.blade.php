<x-customer-layout>
    <div class="container bg-white text-body">
        <div class="row mb-3 mt-3">
            <h2>Cart List</h2>
            <hr class="border-dark" style="width: 25%">
        </div>
        @foreach ($reservations as $reservation)
            <div class="container d-flex align-items-center">
                <div class="row text-white mt-2 rounded" style="background-color: rgba(0, 0, 0, 0.5)">
                    <div class="col mt-2 mb-2">
                        <img src="{{ Storage::url($reservation->restaurant->image) }}" class="img-fluid">
                    </div>
                    <div class="col mt-2 mb-2">
                        <div class="row text-white">
                            <h3>{{ $reservation->restaurant->name }}</h3>
                            <p>{{ $reservation->restaurant->address }}</p>
                            <hr class="border-dark">
                            <p>Reservation Date : {{ $reservation->reservation_date }}</p>
                            <p>Guest Number : {{ $reservation->guest_number }}</p>
                            <p>Table : {{ $reservation->table->name }}</p>
                            <p class="mt-3"> Created At : {{ $reservation->created_at }}</p>
                        </div>
                    </div>
                    <div class="col mt-4">
                        <div class="d-flex justify-content-center mt-5">
                            <a href="#" class="btn btn-lg btn-primary">Manage Cart Detail</a>
                        </div>
                        <div class="d-flex justify-content-center mt-5">
                            <a href="#" class="btn btn-lg btn-danger">Cancel Reservation</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="d-flex justify-content-center mt-3">
            {{ $reservations->links('pagination::bootstrap-5') }}
        </div>
    </div>
</x-customer-layout>
