<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ URL::asset('usertemplate/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('usertemplate/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ URL::asset('usertemplate/css/bootstrap.min.css') }}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{ URL::asset('usertemplate/css/style.css') }}">

    <title>Sign In User</title>
</head>
<body>  
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ URL::asset('usertemplate/images/undraw_remotely_2j6y.svg') }}" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <h3>Reset Password</h3>
                            </div>
                            <form action="{{ route('password.email') }}" method="post">
                                @csrf
                                <div class="form-group first mb-1">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email">

                                </div>
                                <span class="text-danger mb-4">@error('email')<b>{{ $message }}</b>@enderror</span>

                                <input type="submit" value="Send Reset Link" class="btn btn-block btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    
    <script src="{{ URL::asset('usertemplate/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ URL::asset('usertemplate/js/popper.min.js') }}"></script>
    <script src="{{ URL::asset('usertemplate/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('usertemplate/js/main.js') }}"></script>
    @include('sweetalert::alert')   

</body>
</html>