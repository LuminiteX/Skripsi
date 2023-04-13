<x-customer-layout>
    <div class="container mt-0">
        <div class="row justify-content-center mt-0">
            <div class="col-12 col-xxl-8 mt-0">
                <a href="{{ route('menu.index', $menu->restaurant_id) }}" class="btn btn-sm btn-primary mt-5 mb-5">Return
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
                                    <label for="qty" class="col-md-3 col-form-label">Qty</label>

                                    <div class="col-lg-4 col-md-8">
                                        <input type="number" class="form-control" id="qty" name="qty">
                                    </div>

                                    <div
                                        class="col-lg-4 col-md-8 mt-sm-2 mt-lg-0 justify-content-sm-center justify-content-md-none">
                                        <button type="submit" class="btn btn-primary">Add to Cart</button>
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
