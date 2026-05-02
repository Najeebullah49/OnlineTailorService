@extends('layouts.masterLayout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@section('title')
      SignUp
      @endsection</title>
   <!-- In the <head> section -->
<link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet">



     <link rel="stylesheet" href=
    "https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"
              integrity=
    "sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg=="
              crossorigin="anonymous" 
              referrerpolicy="no-referrer" /> 
</head>
<body>
 
 

<div class="container-fluid">
    <div class="row row-cols-1 row-cols-lg-2 row-cols-md-2 row-cols-sm-1 row-cols-xm-1">
      <div class="col col-lg-7 bg-white p-0">
        <img src="{{asset('images/cloths4.jpg')}}" class="img-fluid" height="550" alt="">
      </div>
      <div class="col-lg-4 col-sm-12 my-2 mx-auto">
        <div class="border border-1 border-warning my-1 rounded mx-auto bg-light">


          <h3 class="card-title mx-5 my-2">Create an account</h3>
          
            <form class="mx-2 my-2" action="{{ URL::to('registerUser') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-1">
        <label for="fullname" class="form-label">Full Name</label>
        <input 
            class="form-control @error('name') is-invalid @enderror" 
            type="text" 
            name="name" 
            id="fullname" 
            value="{{ old('name') }}" 
            required>
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-1">
        <label for="email" class="form-label">Email</label>
        <input 
            class="form-control @error('email') is-invalid @enderror" 
            type="email" 
            name="email" 
            id="email" 
            value="{{ old('email') }}" 
            required>
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-1">
        <label for="file" class="form-label">Picture</label>
        <input 
            class="form-control @error('file') is-invalid @enderror" 
            type="file" 
            name="file" 
            id="file">
        @error('file')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-1">
        <label for="password" class="form-label">Password</label>
        <input 
            class="form-control @error('password') is-invalid @enderror" 
            type="password" 
            name="password" 
            id="password" 
            required>
        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-1">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input 
            class="form-control" 
            type="password" 
            name="password_confirmation" 
            id="password_confirmation" 
            required>
    </div>

    <button class="btn btn-primary w-100 mt-3 mb-3" type="submit">Sign Up</button>
</form>

         <div class="form-control bg-white col-sm-12 col-xm-12 mx-auto">
          <!-- <svg class="w-6 h-6 text-gray-800 dark:text-white ms-5 border rounded-circle border-1 border-primary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M12.037 21.998a10.313 10.313 0 0 1-7.168-3.049 9.888 9.888 0 0 1-2.868-7.118 9.947 9.947 0 0 1 3.064-6.949A10.37 10.37 0 0 1 12.212 2h.176a9.935 9.935 0 0 1 6.614 2.564L16.457 6.88a6.187 6.187 0 0 0-4.131-1.566 6.9 6.9 0 0 0-4.794 1.913 6.618 6.618 0 0 0-2.045 4.657 6.608 6.608 0 0 0 1.882 4.723 6.891 6.891 0 0 0 4.725 2.07h.143c1.41.072 2.8-.354 3.917-1.2a5.77 5.77 0 0 0 2.172-3.41l.043-.117H12.22v-3.41h9.678c.075.617.109 1.238.1 1.859-.099 5.741-4.017 9.6-9.746 9.6l-.215-.002Z" clip-rule="evenodd"/>
          </svg> -->
          <!-- <a class="text-center form-text my-2 text-primary mx-2 " href="#">
            Sign up with Google</a>
         </div> -->
          <h6 class="text-center d-flex mt-3 mb-3 mx-5 ">Already have an account? <a class=" mx-auto" href="{{route('login')}}">Login</a></h6>
        </div>
      </div>
      
    </div>
  </div>
  

        
   <!-- Before the closing </body> tag -->
   <script src="{{asset('css/js/bootstrap.bundle.min.js') }}"></script>

<!-- Bootstrap Bundle JS (includes Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
@endsection