<x-customer-layout>
    <div class="container">
        @if (session('message'))
            <div class="alert alert-info mt-2">{{ session('message') }}</div>
        @endif
        <div class="row">
            <div class="col-md-6 offset-md-3 mt-4">
                <form action="{{ route('restaurants.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Search for restaurants..."
                            value="{{ Request::get('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-search"></i> Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mt-4">
            @foreach ($restaurants as $index => $restaurant)
                @if ($index % 3 == 0 && $index != 0)
        </div>
        <div class="row mt-4">
            @endif
            <div class="col-md-4 mb-4">
                <div class="card"
                    style="padding: .5em .5em .5em; border-radius: 1em; box-shadow: 0 5px 10px rgba(0,0,0,.2); min-height:450px; max-height:450px;">
                    <img src="{{ Storage::url($restaurant->image) }}" class="card-img-top" alt="{{ $restaurant->name }}"
                        style="min-height: 150px;max-height: 150px;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $restaurant->name }}</h5>
                        <p class="card-text">Restaurant Address: {{ $restaurant->address }}</p>
                        <p class="card-text">
                            Rating:
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $restaurant->rating)
                                    <i class="fas fa-star text-warning" style="color: gold;"></i>
                                @elseif($i == ceil($restaurant->rating))
                                    <i class="fas fa-star-half-alt text-warning" style="color: gold;"></i>
                                @else
                                    <i class="far fa-star text-warning" style="color: gold;"></i>
                                @endif
                            @endfor
                        </p>
                        <p class="card-text">Views: {{ $restaurant->view }}</p>
                        <div class="mt-auto">
                            <div class="button-container d-flex justify-content-center">
                                <a href="{{ route('restaurants.details', $restaurant->id) }}"
                                    class="btn btn-primary">View Restaurant</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                {{ $restaurants->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

</x-customer-layout>
