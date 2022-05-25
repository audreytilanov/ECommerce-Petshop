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

    <title>Register User</title>
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
              <h3>Register New User</h3>
              <p class="mb-4"><a class="text-warning font-weight-bold" href="{{ route('user.login') }}">I already have an account!</a></p>
            </div>
            <form action="{{ route('user.create') }}" method="post">
                @csrf
                <div class="form-group first mb-1">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
                </div>
                <span class="text-danger">@error('name')<b>{{ $message }}</b>@enderror</span>
                <div class="form-group first mb-1">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>
                <span class="text-danger">@error('email')<b>{{ $message }}</b>@enderror</span>
                <div class="form-group last mb-1">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{ old('name') }}" required autofocus>
                </div>
                <span class="text-danger">@error('password')<b>{{ $message }}</b>@enderror</span>
                <div class="form-group last mb-4">
                    <label for="cpassword">Confirm Password</label>
                    <input type="password" class="form-control" id="cpassword" name="cpassword" value="{{ old('name') }}" required autofocus>
                </div>
                <span class="text-danger mb-4">@error('cpassword')<b>{{ $message }}</b>@enderror</span>
                <div class="d-flex mb-5 align-items-center">
                    <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                    <input type="checkbox" checked="checked"/>
                    <div class="control__indicator"></div>
                    </label>
                    <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> 
                </div>

                <input type="submit" value="Log In" class="btn btn-block btn-primary">
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