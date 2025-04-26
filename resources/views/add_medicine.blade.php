@extends('master')
@section('content')
<div class="container">
    <h2>Add New Medicine</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ url('/add_medicine') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Medicine Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="medicine_gm" class="form-label">Grams</label>
            <input type="text" class="form-control" id="medicine_gm" name="medicine_gm" required>
        </div>

        <div class="mb-3">
            <label for="uses" class="form-label">Uses</label>
            <textarea class="form-control" id="uses" name="uses" required></textarea>
        </div>

        <div class="mb-3">
            <label for="tables" class="form-label">Tablets</label>
            <input type="number" class="form-control" id="tables" name="tables" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price (₹)</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Medicine</button>
    </form>
</div>
@endsection