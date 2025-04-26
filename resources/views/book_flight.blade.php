@extends('master')
@section('content')
    <<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Flight Details</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Airline:</strong> {{ $flight->airline_name }}</p>
                            <p><strong>Flight Number:</strong> {{ $flight->flight_number }}</p>
                            <p><strong>From:</strong> {{ $flight->departure_airport }}</p>
                            <p><strong>To:</strong> {{ $flight->arrival_airport }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Departure:</strong> {{ \Carbon\Carbon::parse($flight->departure_time)->format('M d, Y H:i') }}</p>
                            <p><strong>Arrival:</strong> {{ \Carbon\Carbon::parse($flight->arrival_time)->format('M d, Y H:i') }}</p>
                            <p><strong>Price:</strong> ₹{{ number_format($flight->price, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <h3 class="card-title">Select Your Seat</h3>

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('seats.reserve') }}">
                        @csrf
                        <div class="seat-map">
                            @if($available_seats->count())
                                @foreach($available_seats as $seat)
                                    <div class="seat available" data-seat-id="{{ $seat->seat_id }}">
                                        {{ $seat->seat_number }}
                                    </div>
                                @endforeach
                            @else
                                <div class="alert alert-warning">No seats available for this flight.</div>
                            @endif
                        </div>
                        <input type="hidden" name="seat_id" id="selected_seat">
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary" {{ $available_seats->count() ? '' : 'disabled' }}>Proceed to Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection