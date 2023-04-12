<x-customer-layout>
<div class="container bg-white text-body">
    <div class="row mb-3 mt-3">
        <h2>Cart List</h2>
        <hr class="border-dark" style="width: 25%">
    </div>
    <div class="container d-flex align-items-center">
        @foreach ($restaurants as $restaurant)
            <div class="row bg-secondary text-white">
                <div class="col">
                    <img src="{{ Storage::url($restaurant->image) }}" class="img-fluid">
                </div>
                <div class="col">
                    <div class="row text-white">
                        <h3>{{ $restaurant->name }}</h3>
                        <p>{{ $restaurant->address }}</p>
                        <hr class="border-dark">
                        <p>Reservation Date: 2023/11/30 13:00</p>
                        <p>Guest Number: 4</p>
                        <p>Table Number: 14</p>
                        <p class="mt-3"> Created At: 2023/4/12 15:55</p>
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
        @endforeach

    </div>
</div>
</x-customer-layout>
