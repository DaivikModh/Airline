@extends('master')

@section('content')
<div class="container mt-5">

    @if(isset($flights) && $flights->count() > 0)
        <hr>
        <h4 class="mt-4">Available Flights</h4>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th id="flight_id" class="d-none">Flight ID</th>
                    <th>Flight Number</th>
                    <th>Airline</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Departure</th>
                    <th>Arrival</th>
                    <th>Available Seats</th>
                    <th>Price</th>
                    <th>Book</th>
                </tr>
            </thead>
            <tbody>
                @foreach($flights as $flight)
                    <tr>
                        <td class="d-none">{{ $flight->flight_id }}</td>
                        <td>{{ $flight->flight_number }}</td>
                        <td>{{ $flight->airline_name }}</td>
                        <td>{{ $flight->departure_airport }}</td>
                        <td>{{ $flight->arrival_airport }}</td>
                        <td>{{ \Carbon\Carbon::parse($flight->departure_time)->format('Y-m-d H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($flight->arrival_time)->format('Y-m-d H:i') }}</td>
                        <td>{{ $flight->available_seats }}</td>
                        <td>₹{{ number_format($flight->price, 2) }}</td>
                        <td>
                            <a href="{{ route('booking', ['flight_id' => $flight->flight_id]) }}">
                                <button class="btn btn-primary">Book</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif(isset($flights))
        <hr>
        <p class="text-danger mt-4">No flights found matching your criteria.</p>
    @endif
</div>
@endsection
