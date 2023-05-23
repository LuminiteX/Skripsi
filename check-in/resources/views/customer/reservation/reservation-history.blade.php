<x-customer-layout>

    @if (session('message'))
        <div class="alert alert-success mt-2">{{ session('message') }}</div>
    @endif

    <div class="container bg-white text-body">
        <div class="row mb-3 mt-3">
            <div class="col-lg-10 text-left">
                <h2>Reservation History</h2>
                <hr class="border-dark" style="width: 50%">
            </div>
            <div class="col-md-2 align-self-center">
                <a href="{{ route('reservations.list') }}" class="btn btn-primary" style="width: 113px">Back</a>
            </div>
        </div>
        @if (!count($reservations) == 0)
            @foreach ($reservations as $reservation)
                <div class="container d-flex align-items-center">
                    <div class="row text-white mt-3"
                        style="background-color: rgba(0, 0, 0, 0.4); padding: .5em .5em .5em; border-radius: 2em; box-shadow: 0 5px 10px rgba(0,0,0,.2);">
                        <div class="col-sm-12 col-md-4 pt-3 pb-3">
                            <img src="{{ Storage::url($reservation->restaurant->image) }}" class="img-fluid"
                                style="width: 100%;height: 100%; object-fit: cover">
                        </div>
                        <div class="col-sm-12 col-md-4 mt-2 mb-2">
                            <div class="row text-white">
                                <h3>{{ $reservation->restaurant->name }}</h3>
                                <p>{{ $reservation->restaurant->address }}</p>
                                <hr class="border-dark">
                                <p>Reservation Date: {{ $reservation->reservation_date }}</p>
                                <p>Guest Number: {{ $reservation->guest_number }}</p>
                                <p>Table: {{ $reservation->table->name }}</p>
                                <p> Created At: {{ $reservation->created_at }}</p>
                                <b>Reservation with menu: @if ($reservation->cart_header)
                                        Yes
                                    @else
                                        No
                                    @endif </b>
                                <b>Reservation Status: @if ($reservation->reservation_status == 4)
                                        Reservation finished
                                    @elseif ($reservation->reservation_status == 5)
                                        Reservation finished
                                    @elseif ($reservation->reservation_status == 6)
                                        Reservation rejected
                                    @else
                                        Reservation canceled
                                    @endif
                                </b>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 mt-4 justify-content-center align-items-center">
                            @if ($reservation->reservation_status == 4)
                                <div class="d-flex justify-content-center mt-5">
                                    <a href="{{ route('reservations.feedback', $reservation->id) }}"
                                        class="btn btn-lg btn-primary" style="width: 199px">Give
                                        Feedback</a>
                                </div>
                                @if ($reservation->cart_header)
                                    <div class="d-flex justify-content-center mt-5">
                                        <a href="{{ route('reservations.detail.with.menu', $reservation->id) }}"
                                            class="btn btn-lg btn-danger">View Reservation</a>
                                    </div>
                                @else
                                    <div class="d-flex justify-content-center mt-5">
                                        <a href="{{ route('reservations.detail.without.menu', $reservation->id) }}"
                                            class="btn btn-lg btn-danger">View Reservation</a>
                                    </div>
                                @endif
                            @else
                                @if ($reservation->cart_header)
                                    <div class="d-flex justify-content-center mt-5"></div>
                                    <div class="d-flex justify-content-center mt-5">
                                        <a href="{{ route('reservations.detail.with.menu', $reservation->id) }}"
                                            class="btn btn-lg btn-danger">View Reservation</a>
                                    </div>
                                @else
                                    <div class="d-flex justify-content-center mt-5"></div>
                                    <div class="d-flex justify-content-center mt-5">
                                        <a href="{{ route('reservations.detail.without.menu', $reservation->id) }}"
                                            class="btn btn-lg btn-danger">View Reservation</a>
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
        @else
            <h3 class="mb-0 text-md"> <i class="fas fa-info-circle mr-2" style="color:grey;"></i> No reservations in
                history yet
            </h3>
        @endif

    </div>
</x-customer-layout>
