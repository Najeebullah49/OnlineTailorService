@extends('layouts.masterLayout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@section('title')
     SignIn
      @endsection</title>
   <!-- In the <head> section -->
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

<style>
  .position-relative {
    position: relative;
}

.position-absolute {
    position: absolute;
}

</style>

    {{-- <link rel="stylesheet" href=
    "https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"
              integrity=
    "sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg=="
              crossorigin="anonymous" 
              referrerpolicy="no-referrer" /> --}}
</head>
<body>


<div class="container-fluid">
    <div class="row row-cols-1 row-cols-lg-2 row-cols-md-2 row-cols-sm-1 row-cols-xm-1">
      <div class="col col-lg-7 bg-white p-0">
        <img src="{{asset('images/cloths4.jpg')}}" class="img-fluid" height="550" alt="">
      </div>
      <div class="col col-lg-4 col-sm-12 my-5 mx-auto">
        <div class="border border-1 border-warning my-5 rounded mx-auto bg-light">
          @if(session()->has('success'))
          <div class="alert alert-success">
            <p> {{ session()->get('success') }} </p>
          </div>
          @endif

           @if(session()->has('error'))
          <div class="alert alert-danger">
            <p> {{ session()->get('error')}} </p>
          </div>
          @endif 
          
          <h3 class=" my-3 mb-3 text-center">Login into account</h3>
          <form class="mx-2 my-2" action="{{ URL::to('loginUser') }}" method="POST">
              @csrf
            <div class="mb-2">
              <label for="UseridEmail" class="form-label">Email</label>
              <input class="form-control" type="email" name="email" id="UseridEmail" aria-describedby="emailHelp">

            </div>

    <div class="mb-2">
              <!-- start -->
              <div class="form-group position-relative">
    <label for="password">Password</label>
    <input type="password" id="password" name="password" class="form-control">
    <i id="togglePassword" class="fa fa-eye position-absolute" style="right: 10px; top: 70%; cursor: pointer; transform: translateY(-50%);"></i>
</div>

<!-- end    -->
            </div>
            <button class="btn btn-primary w-100 mb-3 mt-3" type="submit">Login</button>

          </form>
         <div class="ms-5 mb-5">Do you have an account? <a class="text-center ms-" href="{{route('signUp')}}">Sign up</a></div>
          <!-- <h6 class="text-center d-flex ms-5 mb-3 mt-3 my-2"><a class="" href="#">Forgot password?</a></h6>
         -->
        </div>
      </div>
    </div>
  </div>
<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
        // Toggle the type attribute
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle the eye icon class
        this.classList.toggle('fa-eye-slash');
    });
</script>

   <!-- Before the closing </body> tag -->
   <script src="{{asset('css/js/bootstrap.bundle.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}
</body>
</html>
@endsection