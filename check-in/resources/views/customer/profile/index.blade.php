<x-customer-layout>
    <div class="container bg-white text-body">
        <div class="row text-center mb-3 mt-3">
            <h2>Your Profile</h2>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <img src="{{ Storage::url($user->image) }}" alt="profile" class="img-fluid">
            </div>
            <div class="col-md-6 col-sm-12">
                <h4>Name</h4>
                <hr class="border-dark">
                <p class="text-gray-600 mb-4">
                    {{ $user->name }}
                </p>
                <div class="row">
                    <div class="col">
                        <h4>Email</h4>
                        <hr>
                        <p class="text-gray-600 mb-4">
                            {{ $user->email }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h4>Phone Number</h4>
                        <hr>
                        <p class="text-gray-600 mb-4">
                            {{ $user->phone_number }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h4>Address</h4>
                        <hr>
                        <p class="text-gray-600 mb-4">
                            {{ $user->address }}
                        </p>
                    </div>
                    <div class="mt-2 mb-4">
                        <a href="{{ route('customer.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-customer-layout>
