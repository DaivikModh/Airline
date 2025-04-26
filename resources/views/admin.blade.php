@extends('master')
@if(session("Success"))
    <script>
        Swal.fire({
            icon : 'Success',
            title : 'Success!',
            text : "Flight Added Successfully",
        });
        location.reload();
    </script>
@endif
@section('content')
    @if(session('admin') === true)
    <div class="container mt-4">
        <h2>Admin Panel</h2>

        <!-- Alert Boxes -->
        <div class="alert alert-danger d-none" id="error-alert">An error occurred</div>
        <div class="alert alert-success d-none" id="success-alert">Action successful</div>

        <div class="row">
            <!-- Flight Form -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3>Add New Flight</h3>
                        <form action="/add_flight" method="POST" id="flight-form">
                            @csrf
                            <div class="mb-3">
                                <label for="airline_id" class="form-label">Airline</label>

                                <div class="d-flex align-items-center gap-2">
                                    <select class="form-select" id="airline_id" name="airline_id" required>
                                    @foreach($airlines as $airline)
                                        <option value="{{ $airline->airline_id }}">{{ $airline->airline_name }}</option>
                                    @endforeach
                                    </select>

                                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">+</a>
                                </div>

                                <div class="collapse multi-collapse mt-2" id="multiCollapseExample1">
                                    <div class="card card-body">
                                    <form action="/add_airline" method="POST">

                                    </form>
                                    </div>
                                </div>
                                </div>

                            <div class="mb-3">
                                <label for="flight_number" class="form-label">Flight Number</label>
                                <input type="text" class="form-control" id="flight_number" name="flight_number" required>
                            </div>
                            <div class="mb-3">
                                <label for="departure_airport" class="form-label">Departure Airport</label>
                                <input type="text" class="form-control" id="departure_airport" name="departure_airport" required>
                            </div>
                            <div class="mb-3">
                                <label for="arrival_airport" class="form-label">Arrival Airport</label>
                                <input type="text" class="form-control" id="arrival_airport" name="arrival_airport" required>
                            </div>
                            <div class="mb-3">
                                <label for="departure_time" class="form-label">Departure Time</label>
                                <input type="datetime-local" class="form-control" id="departure_time" name="departure_time" required>
                            </div>
                            <div class="mb-3">
                                <label for="arrival_time" class="form-label">Arrival Time</label>
                                <input type="datetime-local" class="form-control" id="arrival_time" name="arrival_time" required>
                            </div>
                            <!-- <div class="mb-3">
                                <label for="total_seats" class="form-label">Total Seats</label>
                                <input type="number" class="form-control" id="total_seats" name="total_seats" value="180" required>
                            </div> -->
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Flight</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Flight Table -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3>Existing Flights</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Flight Number</th>
                                        <th>Airline</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Departure</th>
                                        <th>Arrival</th>
                                        <th>Available Seats</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="flight-table-body">
                                @foreach($flights as $flight)
                                    <tr>
                                        <td class="flight-id d-none">{{$flight->flight_id}}</td>
                                        <td>{{$flight->flight_number}}</td>
                                        <td>{{$flight->airline_name}}</td>
                                        <td>{{$flight->departure_airport}}</td>
                                        <td>{{$flight->arrival_airport}}</td>
                                        <td>{{$flight->departure_time}}</td>
                                        <td>{{$flight->arrival_time}}</td>
                                        <td>{{$flight->available_seats}}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" onclick="deleteFlight(this)">Delete</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteFlight(button) {
            let id =  $(button).closest('tr').find('.flight-id').text().trim();
            if (confirm("Are you sure you want to delete this flight?")) {
                $.ajax({
                    url: "/delete_flight",
                    type: "POST",
                    data: { id: id },
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response === "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: "{{ session('Success') }}",
                        });
                        location.reload();
                    } 
                }
            });
        }
    } 
    </script>
    @else
        <script>window.location.href = '/login';</script>
    @endif
@stop
