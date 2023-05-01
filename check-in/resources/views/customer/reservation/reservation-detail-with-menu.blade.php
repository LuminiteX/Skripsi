<x-customer-layout>
    <div class="container" style="background-color:white;">
        <div class="row mb-3 mt-3">
            <a href="{{ route('reservations.list') }}" class="btn btn-primary btn-lg mt-5 mb-1"
                style="width: 183px">Back</a>
        </div>
        <div class="row mb-2 mt-3">
            <div class="col card-header">
                <h2>Reservation Detail</h2>
            </div>
        </div>
        <div class="card-body w-100 p-0">
            <div class="row mb-2">
                <div class="col-md-12">
                    <h2 class="mb-4"><strong>Full Name:</strong> {{ $reservations->user->name }}</h2>
                    <h2 class="mb-4"><strong>Restaurant Name:</strong> {{ $reservations->restaurant->name }}</h2>
                    <h2 class="mb-4"><strong>Reservation Date:</strong>
                        {{ \Carbon\Carbon::parse($reservations->reservation_date)->format('d F Y') }}</h2>
                    <h2 class="mb-4"><strong>Reservation Time:</strong>
                        {{ \Carbon\Carbon::parse($reservations->reservation_date)->format('H:i a') }}</h2>
                    <h2 class="mb-4"><strong>Guest Number:</strong> {{ $reservations->guest_number }}</h2>
                    <h2 class="mb-4"><strong>Table Number:</strong> {{ $reservations->table->name }}</h2>
                </div>
                <div class="col-md-12">
                    <h2 class="mb-4"><strong>Restaurant Description:</strong></h2>

                    <p class="mb-4">{!! nl2br(e($reservations->restaurant->description)) !!}</p>
                </div>
                <div class="col-md-12">
                    <h2 class="fw-bold mb-4">Contact Number</h2>
                    <p>Phone: {{ $reservations->restaurant->phone_number }}</p>
                    <p class="mb-4">Email: {{ $reservations->restaurant->user->email }}</p>
                </div>
                <div class="col-md-12">
                    <h2 class="mb-4"><strong>Restaurant Address:</strong></h2>
                    <p class="mb-4">{{ $reservations->restaurant->address }}</p>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <h2 class="text-lg font-bold mb-2">Payment Summary</h2>
            <p class="text-lg font-bold">Please Review the following details for this transaction</p>

            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">Image</th>
                                    <th scope="col" class="text-center">Name</th>
                                    <th scope="col" class="text-center">Price</th>
                                    <th scope="col" class="text-center">Quantity</th>
                                    <th scope="col" class="text-center">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations->cart_header->cart_detail as $item)
                                    <tr>
                                        <td class="text-center align-middle">
                                            <img class="img-thumbnail rounded-circle" style="height: 50px; width: 50px;"
                                                src="{{ Storage::url($item->menu->image) }}"
                                                alt="{{ $item->menu->name }}">
                                        </td>
                                        <td class="text-center align-middle">{{ $item->menu->name }}</td>
                                        <td class="text-center align-middle">
                                            {{ 'Rp ' . number_format($item->menu->price, 0, ',', '.') }}</td>
                                        <td class="text-center align-middle">{{ $item->quantity }}</td>
                                        <td class="text-center align-middle">
                                            {{ 'Rp ' . number_format($item->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" class="text-end font-medium">Total</td>
                                    <td class="text-center">
                                        {{ 'Rp ' . number_format($reservations->cart_header->total, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5 mb-5">
            <div class="row mt-5 mb-5">
                <h2 class="text-lg font-bold mb-2">Proof of Transaction</h2>
                <div class="image-container"
                    style="width: {{ getimagesize(Storage::path($reservations->cart_header->image))[0] }}px; height: {{ getimagesize(Storage::path($reservations->cart_header->image))[1] }}px; max-width: 400px; max-height: 400px;">
                    <a href="{{ Storage::url($reservations->cart_header->image) }}" target="_blank" class="image-link">
                        <img class="img-fluid" src="{{ Storage::url($reservations->cart_header->image) }}"
                            alt="Header image">
                    </a>
                </div>
            </div>
            <div class="row mt-5 mb-5">
                <form method="POST" action="{{ route('reservations.detail.with.menu.store', $reservations->id) }}"
                    enctype="multipart/form-data" class="mt-5">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="image">Choose Image:</label>
                        <div class="custom-file">
                            <div class="col-4">
                                <input class="form-control" type="file" id="formFile" disabled>
                            </div>
                        </div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-5 mt-5">
                        <button type="submit" class="btn btn-primary btn-lg" disabled>Finish Upload Receipt</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-customer-layout>
