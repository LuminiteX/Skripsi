<x-customer-layout>
    <div class="container bg-white text-body">
        <div class="row text-center mb-3 mt-3">
            <h2>Edit Profile</h2>
        </div>
        <div class="row">
            <div class="col">
                @if ($user->image)
                    <img src="{{ Storage::url($user->image) }}" alt="Uploaded Image" class="img-fluid">
                @else
                    <p>No image uploaded yet.</p>
                @endif
            </div>
            <div class="col">
                <form method="POST" action="{{ route('customer.profile.edit.save') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $user->name }}">
                        @error('name')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                            value="{{ $user->phone_number }}">
                        @error('phone_number')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ $user->address }}">
                        @error('address')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-2">
                        <label for="image" class="form-label">Choose image file:</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @error('image')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-4 mb-2">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</x-customer-layout>
