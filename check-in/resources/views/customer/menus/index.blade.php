<x-customer-layout>
    {{-- <div class="col-md-12 mb-5 ">
        <h5 class="fw-bold mb-3 px-5">Category</h5>
        <div class="row row-cols-1 row-cols-md-3 g-3 px-5">
            @foreach ($categories as $category)
                <div class="col">
                    <div class="card h-100">
                        <div class="row g-0">
                            <div class="col-md-4 p-2 align-items-center">
                                <img src="{{ Storage::url($category->image) }}"
                                    class="img-fluid rounded-start mx-auto d-block" alt="{{ $category->name }}"
                                    style="max-height: 200px;">
                            </div>
                            <div class="col-md-8" style="display: flex; flex-direction: column;">
                                <div class="card-body" style="flex-grow: 1;">
                                    <h5 class="card-title">{{ $category->name }}</h5>
                                    <p class="card-text"
                                        style="overflow: hidden; text-overflow: ellipsis; height: 80px;">
                                        {{ $category->description }}
                                    </p>
                                </div>
                                <div class="card-footer d-flex justify-content-start"
                                    style="background-color: rgba(0,0,0,0) !important; border-top: none !important;">
                                    <a href="{{ route('menu.sort.by', $category->id) }}"
                                        class="btn btn-sm btn-primary">View Menu</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>
    </div> --}}
    <div class="col-md-12 mb-5 ">
        <h5 class="fw-bold mb-3 mt-3 px-5">Category</h5>
        <div class="row row-cols-1 row-cols-md-3 g-3 px-5">
            @foreach ($categories as $category)
                <div class="col">
                    <div class="card h-100">
                        <div class="row g-0">
                            <div class="col-md-4 p-2 align-items-center">
                                <img src="{{ Storage::url($category->image) }}"
                                    class="img-fluid rounded-start mx-auto d-block" alt="{{ $category->name }}"
                                    style="max-height: 150px; min-height:150px;object-fit: contain;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body" style="height: 150px; overflow-y: auto;">
                                    <h5 class="card-title">{{ $category->name }}</h5>
                                    <p class="card-text" style="overflow-wrap: break-word;">{{ $category->description }}
                                    </p>
                                </div>
                                <div class="card-footer d-flex justify-content-start"
                                    style="background-color: rgba(0,0,0,0) !important; border-top: none !important">
                                    <a href="{{ route('menu.sort.by', ['category' => $category->id, 'reservation' => $reservation->id]) }}"
                                        class="btn btn-sm btn-primary">View Menu</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>
    </div>
    <h2 class="my-4 mx-md-5 mx-xl-5 bottom-2">Menu</h2>
    <div class="container-fluid px-5 py-6 mx-auto mb-5">
        <div class="row row-cols-1 row-cols-lg-3 g-4">
            @foreach ($menus as $menu)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ Storage::url($menu->image) }}" alt="Image"
                            class="card-img-top h-50 object-fit-cover">
                        <div class="card-body">
                            @if ($menu->chef_recommendation)
                                <span class="badge bg-warning text-dark mb-2">Chef Recommendation</span>
                            @endif
                            <h5 class="card-title">{{ $menu->name }}</h5>
                            <p class="card-text">
                                {{ \Illuminate\Support\Str::limit($menu->description, 200, $end = '...') }}</p>

                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <span
                                class="text-success font-weight-bold">{{ 'Rp ' . number_format($menu->price, 0, ',', '.') }}</span>
                            <a href="{{ route('menu.detail', ['menu' => $menu->id, 'reservation' => $reservation->id]) }}"
                                class="btn btn-sm btn-primary">View
                                Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-5 mb-3">
            <a href="{{ route('cart.list.detail', ['reservation' => $reservation->id]) }}"
                class="btn btn-lg btn-warning">Manage Cart
                Details</a>
        </div>
    </div>
</x-customer-layout>
