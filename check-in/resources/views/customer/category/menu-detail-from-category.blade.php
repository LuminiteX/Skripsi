<x-customer-layout>
    <div class="container mt-0">
        <div class="row justify-content-center mt-0">
            <div class="col-12 col-xxl-8 mt-0">
                <a href="{{ route('menu.sort.by', ['category' => $categories->id, 'reservation' => $reservation->id]) }}"
                    class="btn btn-sm btn-primary mt-5 mb-5">Return
                    Back
                    to
                    menu</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-xxl-8 mt-2 mb-5">
                <div class="card">
                    <div class="card-header text-center fs-3 fw-bold">{{ $menu->name }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 d-flex justify-content-center">
                                <img src="{{ Storage::url($menu->image) }}" alt="{{ $menu->name }}" class="img-fluid">
                            </div>
                            <div class="col-md-6">
                                <p>{{ $menu->description }}</p>
                                <p>Category: {{ $categories->name }}</p>
                                <p>Price: {{ 'Rp ' . number_format($menu->price, 0, ',', '.') }}</p>
                                <div class="form-group row">
                                    <form method="POST"
                                        action="{{ route('cart.store.from.category', ['category' => $categories->id, 'reservation' => $reservation->id]) }}">
                                        @csrf
                                        <div class="form-group row">
                                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                            <label for="qty" class="col-md-2 col-form-label">Qty</label>
                                            <div class="col-lg-6 col-md-8">
                                                <input type="number" class="form-control" id="qty" name="qty"
                                                    placeholder="1" value=1>
                                            </div>
                                            <div class="col-lg-4 col-md-8 mt-sm-2 mt-lg-0">
                                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                                            </div>
                                            @error('qty')
                                                <div class="text-sm text-danger">{{ $message }}</div>
                                            @enderror

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-customer-layout>
