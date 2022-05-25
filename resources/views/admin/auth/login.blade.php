<!doctype html>
<html lang="en">
<head>
  	<title>Login Superadmin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="{{ URL::asset('templateadmin/css/style.css') }}">

</head>
<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
                <div class="login-wrap wrap p-4 p-lg-5">
                    <div class="d-flex">
                        <div class="w-100">
                            <h3 class="mb-4">Admin Area</h3>
                        </div>
                    </div>
                    <form action="{{ route('admin.check') }}" method="post" class="signin-form">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="label" for="email">Email</label>
                            <input type="text" class="form-control" placeholder="Email" value="{{ old('email') }}" id="email" name="email" required>
                        </div>
                        <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                        <div class="form-group mb-3">
                            <label class="label" for="password">Password</label>
                            <input type="password" class="form-control" placeholder="Password" id="password" name="password" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
                        </div>
                    </form>
                </div>
			</div>
		</div>
	</section>

	<script src="{{ URL::asset('templateadmin/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('templateadmin/js/popper.js') }}"></script>
    <script src="{{ URL::asset('templateadmin/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('templateadmin/js/main.js') }}"></script>
    @include('sweetalert::alert')   

</body>
</html>

