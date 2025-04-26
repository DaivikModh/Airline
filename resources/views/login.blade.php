@extends('master')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session("Fail"))
    <script>
        Swal.fire({
            icon : 'danger',
            title : 'Unable to login!',
            text : "Wrong, username or password",
        });
    </script>
@endif

<div class="login-contect py-5">
    <div class="container py-xl-5 py-3">
        <div class="login-body">
            <div class="login p-4 mx-auto">
                <h5 class="text-center mb-4">Login Now</h5>
                <form action="/login_user" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Your Username</label>
                        <input type="username" class="form-control" name="username" placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label class="mb-2">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="" required="">
                    </div>
                    <button type="submit" class="btn btn-primary submit mt-2 mb-4">Login</button>
                    <p class="forgot-w3ls text-center mb-3">
                        <a href="#" class="text-da">Forgot your password?</a>
                    </p>
                    <p class="account-w3ls text-center text-da">
                        Don't have an account?
                        <a href="register">Create one now</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- //login -->



@stop