<x-customer-layout>
    <div class="container py-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <img class="img-fluid shadow rounded" src="/storage/HomeImg/reservation_image.png" alt="img">
            </div>
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="card-title text-primary mb-4">Make Reservation</h3>
                        <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
                            <li class="nav-item w-100" role="presentation">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50"
                                        aria-valuemin="0" aria-valuemax="100">Step 1</div>
                                </div>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-step1" role="tabpanel"
                                aria-labelledby="pills-step1-tab">
                                <form method="POST" action="{{ route('reservations.store.step.one') }}">
                                    @csrf
                                    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                                    <div class="mb-3">
                                        <label for="guest_number" class="form-label">Guest Number</label>
                                        <input type="number" id="guest_number" name="guest_number"
                                            value="{{ $reservation->guest_number ?? '' }}" class="form-control"
                                            required>
                                        @error('guest_number')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="res_date" class="form-label">Reservation Date</label>
                                        <input type="datetime-local" id="reservation_date" name="reservation_date"
                                            min="{{ $min_date->format('Y-m-d\TH:i:s') }}"
                                            max="{{ $max_date->format('Y-m-d\TH:i:s') }}"
                                            value="{{ $reservation ? $reservation->reservation_date->format('Y-m-d\TH:i:s') : '' }}"
                                            class="form-control" required>
                                        <span class="form-text">Please choose the time between
                                            {{ $formattedTimeOpening }}-{{ $formattedTimeClosing }}.</span>
                                        @error('reservation_date')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        @if (session('message'))
                                            <div class="text-danger">{{ session('message') }}</div>
                                        @endif
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">Next</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            document.querySelector('.hour-picker').addEventListener('click', function() {
                // Enable the input field when the user clicks on it
                this.querySelector('input[type="datetime-local"]').removeAttribute('disabled');
            });

            document.querySelector('.hour-picker').addEventListener('blur', function() {
                // Disable the input field again when the user leaves it
                this.querySelector('input[type="datetime-local"]').setAttribute('disabled', 'disabled');
            });
        </script>
    @endpush
</x-customer-layout>
