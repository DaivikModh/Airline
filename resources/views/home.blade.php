@extends('master')
@section('content')

<div class="hero-section bg-light py-5">
<div class="container position-relative text-white" style="min-height: 80vh;">
    <img src="images/airplane-hero.webp" alt="Airplane" class="img-fluid w-100 h-40 position-absolute top-0 start-0 z-0" style="opacity: 0.75;">

    <div class="d-flex align-items-center justify-content-center h-60 position-relative z-1">
        <div class="text-center mt-5">
            <h1 class="display-4">Find Your Perfect Flight</h1>
            <p class="lead">Book your next adventure with ease and confidence</p>
            <a href="/search" class="btn btn-primary btn-lg mt-3">Search Flights</a>
        </div>
    </div>
</div>
    <!-- Features Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Why Choose Us</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <i class="fas fa-search fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Easy Search</h5>
                        <p class="card-text">Find flights quickly with our intuitive search interface</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <i class="fas fa-chair fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Seat Selection</h5>
                        <p class="card-text">Choose your preferred seat with our interactive seat map</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <i class="fas fa-shield-alt fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Secure Payments</h5>
                        <p class="card-text">Safe and secure payment processing for your peace of mind</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection