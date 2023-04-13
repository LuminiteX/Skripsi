<x-customer-layout>
    <div class="container mx-4">
        <a href="{{ route('menu.index', $restaurant->id) }}" class="btn btn-sm btn-primary mt-5 mb-5">Return Back
            to
            menu</a>
    </div>
    <h2 class="my-4 mx-md-5 mx-xl-5 bottom-2">Menu</h2>
    <div class="container-fluid px-5 py-6 mx-auto">
        <div class="row row-cols-1 row-cols-lg-3 g-4">
            @foreach ($menus as $menu)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ Storage::url($menu->image) }}" alt="Image"
                            class="card-img-top h-50 object-fit-cover">
                        <div class="card-body">
                            <h5 class="card-title">{{ $menu->name }}</h5>
                            <p class="card-text">{{ $menu->description }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <span
                                class="text-success font-weight-bold">{{ 'Rp ' . number_format($menu->price, 0, ',', '.') }}</span>
                            <a href="{{ route('menu.detail', $menu->id) }}" class="btn btn-sm btn-primary">View
                                Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-customer-layout>
