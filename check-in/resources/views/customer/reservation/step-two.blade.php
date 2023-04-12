<x-customer-layout>
    @if (session('error'))
        <div class="alert alert-danger mt-2 mb-2">{{ session('error') }}</div>
    @endif

    @if ($restaurant->tableLayout)
        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($restaurant->tableLayout as $item)
                    <div class="carousel-item{{ $loop->first ? ' active' : '' }}">
                        <img src="{{ Storage::url($item->floor_image) }}" class="d-block w-100 bg-dark"
                            style="height:600px;object-fit: contain;" alt="{{ $item->floor_name }}">
                        <div
                            class="carousel-caption"style="background-color: rgba(0, 0, 0, 0.5); position: absolute; bottom: 0; left: 0; right: 0;">
                            <h5>Floor number {{ $item->floor_number }}</h5>
                            <p>{{ $item->floor_name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    @endif



    <div class="container py-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <img class="object-cover" src="https://cdn.pixabay.com/photo/2021/01/15/17/01/green-5919790__340.jpg"
                    alt="img" />
            </div>
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="card-title text-primary mb-4">Make Reservation</h3>
                        <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
                            <li class="nav-item w-100" role="presentation">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 100%;"
                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Step 2</div>
                                </div>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-step1" role="tabpanel"
                                aria-labelledby="pills-step1-tab">
                                <form method="POST"
                                    action="{{ route('reservations.store.step.two', $restaurant->id) }}">
                                    @csrf
                                    <div class="col-sm-6 pt-2">
                                        <label for="status"
                                            class="form-label font-weight-bold text-gray-700">Table</label>
                                        <div class="mb-3">
                                            <select id="table_id" name="table_id" class="form-select form-control"
                                                style="width: 400px;">
                                                @foreach ($tables as $table)
                                                    <option value="{{ $table->id }}" @selected($table->id == $reservation->table_id)>
                                                        {{ $table->name }} (Location {{ $table->location->name }} For
                                                        {{ $table->guest_number }} Guests)
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('table_id')
                                                <div class="text-sm text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mt-4 p-2 d-flex justify-content-between">
                                        <a href="{{ route('reservations.step.one', $restaurant->id) }}"
                                            class="btn btn-danger rounded-pill px-4 py-2">Previous</a>
                                        <button type="submit" class="btn btn-primary rounded-pill px-4 py-2">Reserve
                                            Table Only</button>
                                        <a href="{{ route('reservations.store.step.two.with.menu', $restaurant->id) }}"
                                            class="btn btn-warning rounded-pill px-4 py-2">Reserve With
                                            Menu</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#myCarousel').carousel();
        });
    </script>
</x-customer-layout>
