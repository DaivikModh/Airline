@extends('master')
@section('content')
<div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Search Flights</h2>
                        <form action="/search_flight" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="from" class="form-label">From</label>
                                    <select class="form-select" name="from" id="from" required>
                                        <option value="">Select departure city</option>
                                        @foreach($from as $place)
                                            <option value="{{$place}}">{{$place}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="to" class="form-label">To</label>
                                    <select class="form-select" name="to" id="to" required>
                                        <option value="">Select destination city</option>
                                        @foreach($to as $place)
                                            <option value="{{ $place }}">{{ $place }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="departure" class="form-label">Departure Date</label>
                                    <input type="date" class="form-control" name="departure" id="departure" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="return" class="form-label">Return Date (Optional)</label>
                                    <input type="date" class="form-control" name="return" id="return">
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Search Flights</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop