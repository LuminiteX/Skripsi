<x-customer-layout>
    <!-- resources/views/cart/detail-list.blade.php -->

    <div class="container my-4">
        <div class="row justify-content-between">
            <div class="col-md-8 text-left">
                <h2 class="d-inline-block">Cart Detail List</h2>
            </div>

            <div class="col-md-2 text-right">
                <a href="{{ route('menu.index', ['restaurant' => $reservation->restaurant->id, 'reservation' => $reservation->id]) }}"
                    class="btn btn-primary ml-auto w-100">Add More</a>
            </div>
        </div>

        <div class="row mt-3 mb-5">
            <div class="col-md-12" style="overflow:auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Number</th>
                            <th>Menu Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!count($cart_details) == 0)
                            @foreach ($cart_details as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><img src="{{ Storage::url($item->menu->image) }}" width="200px"></td>
                                    <td>{{ $item->menu->name }}</td>
                                    <td>{{ 'Rp ' . number_format($item->menu->price, 0, ',', '.') }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ 'Rp ' . number_format($item->subtotal, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <a href="{{ route('cart.list.detail.update', ['menu' => $item->menu->id, 'reservation' => $reservation->id, 'cart_detail' => $item->id]) }}"
                                            class="btn btn-warning">Edit</a>
                                        <form
                                            action="{{ route('cart.list.detail.delete', ['reservation' => $reservation->id, 'cart_detail' => $item->id]) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" class="text-right font-weight-bold">Total Payment:</td>
                                <td colspan="2" class="font-weight-bold">
                                    {{ 'Rp ' . number_format($cart_header->total, 0, ',', '.') }}</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="7" class="text-right font-weight-bold">There is no item in the cart
                                    please add item first</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row justify-content-between mt-5" style="margin-top:300px;margin-">
            <div class="col-md-8 text-left">
                <h5 class="d-inline-block">* Please make sure to upload the receipt in the Reservation List page</h5>
            </div>
            @if (!count($cart_details) == 0)
                <div class="col-md-2 text-right">
                    <form action="{{ route('cart.list.confirm', $reservation->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success ml-auto w-100">Confirm Transaction</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</x-customer-layout>
