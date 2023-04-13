<x-customer-layout>
    <div class="container bg-white text-body">
        <div class="row mb-3 mt-3">
            <div class="col-lg-10 text-left">
                <h2>Reservation List</h2>
                <hr class="border-dark" style="width: 50%">
            </div>
            <div class="col-md-2 align-self-center">
                <a href="{{ route('reservations.history') }}" class="btn btn-primary">View History</a>
            </div>
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
                            <p> Created At : {{ $reservation->created_at }}</p>
                            <b>Reservation with menu: @if ($reservation->cart_header)
                                Yes
                                @else
                                No
                            @endif </b>
                            <b>Reservation Status: @if ($reservation->reservation_status == 1)
                                Receipt not uploaded
                                @elseif ($reservation->reservation_status == 2)
                                Reservation being checked
                                @else
                                Reservation eligible
                            @endif</b>
                        </div>
                    </div>
                    <div class="col mt-4 justify-content-center align-items-center">
                        @if ($reservation->reservation_status == 1)
                            <div class="d-flex justify-content-center mt-5">
                                <a href="#" class="btn btn-lg btn-primary" style="width: 199px">Upload Receipt</a>
                            </div>
                            <div class="d-flex justify-content-center mt-5">
                                <a href="#" class="btn btn-lg btn-danger">Cancel Reservation</a>
                            </div>
                        @else
                            @if ($reservation->cart_header)
                            <div class="d-flex justify-content-center mt-5"></div>
                            <div class="d-flex justify-content-center mt-5">
                                <a href="{{route('reservation.detail.with.menu')}}" class="btn btn-lg btn-danger">View Reservation</a>
                            </div>
                            @else
                            <div class="d-flex justify-content-center mt-5"></div>
                            <div class="d-flex justify-content-center mt-5">
                                <a href="{{route('reservation.detail.without.menu')}}" class="btn btn-lg btn-danger">View Reservation</a>
                            </div>
                            @endif
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
        <div class="d-flex justify-content-center mt-3">
            {{ $reservations->links('pagination::bootstrap-5') }}
        </div>
    </div>
</x-customer-layout>