@extends('master')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@if(session('Success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('Success') }}",
        });
    </script>
@endif

	<!-- login -->
	<div class="login-contect py-5">
		<div class="container py-xl-5 py-3">
			<div class="login-body">
				<div class="login p-4 mx-auto">
					<h5 class="text-center mb-4">Register Now</h5>
					<form action="/submitdata" method="post">
						@csrf
						<div class="form-group">
							<label>Your Name</label>
							<input type="text" class="form-control" name="name" placeholder="" required="">
						</div>
						<div class="form-group">
							<label>Username</label>
							<input type="username" class="form-control" name="username" placeholder="" required="">
						</div>
						<div class="form-group">
							<label>Enter Phone No.</label>
							<input type="phone" class="form-control" name="phone" placeholder="" required="">
						</div>
						<div class="form-group">
							<label>Enter Email</label>
							<input type="email" class="form-control" name="email" id="email" placeholder="" required="" onchange="checkemail()">
							<p id="message"></p>
						</div>

						<div class="form-group">
							<label class="mb-2">Password</label>
							<input type="password" class="form-control" name="password" id="password1" placeholder=""
								required="">
						</div>
						<div class="form-group">
							<label>Confirm Password</label>
							<input type="password" class="form-control" name="password" id="password2" placeholder=""
								required="">
						</div>
						
						<button type="submit" class="btn btn-primary mt-2 mb-4" id="btn-submit">Register</button>
						<p class="text-center">
							<a href="#" class="text-da">By clicking Register, I agree to your terms</a>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
<script>
	
	function checkemail() {
    let email = $("#email").val();

    $.ajax({
        url: "{{ route('checkemail') }}",
        type: "POST",
        data: { email: email },
		headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        success: function(response) {
            if (response === "fail") {
                $("#message").addClass('text-danger');
                $("#message").text("The email already exists");
                $("#btn-submit").prop("disabled", true);
            } else {
                $("#message").text("");
            }
        }
    });
	}
</script>



@stop