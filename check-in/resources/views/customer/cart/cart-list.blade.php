<x-customer-layout>
    <div class="container bg-white text-body">
        <div class="row mb-3 mt-3">
            <h2>Cart List</h2>
            <hr class="border-dark" style="width: 25%">
        </div>

        @if (!count($reservations) == 0)
            @foreach ($reservations as $reservation)
                <div class="container d-flex align-items-center">
                    <div class="row text-white mt-3"
                        style="background-color: rgba(0, 0, 0, 0.4); padding: .5em .5em .5em; border-radius: 2em; box-shadow: 0 5px 10px rgba(0,0,0,.2);">
                        <div class="col-sm-12 col-md-4 pt-2 pb-2">
                            <img src="{{ Storage::url($reservation->restaurant->image) }}" class="img-fluid"
                                style="width: 100%; height: 100%; object-fit: cover">
                        </div>
                        <div class="col-sm-12 col-md-4 mt-2 mb-2">
                            <div class="row text-white">
                                <h3>{{ $reservation->restaurant->name }}</h3>
                                <p>{{ $reservation->restaurant->address }}</p>
                                <hr class="border-dark">
                                <p>Reservation Date: {{ $reservation->reservation_date }}</p>
                                <p>Guest Number: {{ $reservation->guest_number }}</p>
                                <p>Table: {{ $reservation->table->name }}</p>
                                <p class="mt-3"> Created At: {{ $reservation->created_at }}</p>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 mt-4">
                            <div class="d-flex justify-content-center mt-5">
                                <a href="{{ route('cart.list.detail', ['reservation' => $reservation->id]) }}"
                                    class="btn btn-lg btn-primary">Manage Cart Detail</a>
                            </div>
                            <div class="d-flex justify-content-center mt-5">
                                <form action="{{ route('cart.cancel', $reservation->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-lg btn-danger">Cancel Reservation</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-center mt-3">
                {{ $reservations->links('pagination::bootstrap-5') }}
            </div>
        @else
            <h3 class="mb-0 text-md"> <i class="fas fa-info-circle mr-2" style="color:grey;"></i> No cart to be managed
                yet
            </h3>
        @endif

    </div>
</x-customer-layout>
