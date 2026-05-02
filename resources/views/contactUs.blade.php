
@extends('layouts.masterLayout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@section('title')
     Contact Us
       @endsection</title>
   <!-- In the <head> section -->
<link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet">



    {{-- <link rel="stylesheet" href=
    "https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"
              integrity=
    "sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg=="
              crossorigin="anonymous" 
              referrerpolicy="no-referrer" /> --}}
</head>
<body>

  

<div class="container-fluid bg-dark text-light ">
    <div class="row row-cols-1 row-cols-lg-2 row-cols-md-2 row-cols-sm-1 row-cols-xm-1">
      <div class="col">
        <div class="container">
          <h1 class="text-center mt-5 mb-4">Get In Touch</h1>
          <div class="container mt-2 mb-5">Address: Shop 2 near to Sheshmahal resturent University road Karachi
          </div>
          <div class="container mb-5">Email: nu085051@gmail.com</div>
          <div class="container mb-5">Phone: 03000033681</div>
          <div class="container mb-5">Open time: 8am to 10pm</div>
        </div>
      </div>
      <!-- Conatct form -->
      <div class="col bg-white text-dark">
    <h1 class="container text-center  mt-5">Contact with us</h1>
    <div class="container">
    <form action="{{ route('contact.store') }}" method="POST">
    @csrf
    <div class="row row-cols-1 row-cols-lg-2 row-cols-sm-1 my-4"> 
        <div class="col mt-5">
            <input class="form-control" type="text" name="name" placeholder="Name" required>
        </div>
        <div class="col mt-5">
            <input class="form-control" type="email" name="email" placeholder="Email" required>
        </div>
    </div>
    <div class="container">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-sm-1 mb-4"> 
            <input class="col form-control mt-3" type="text" name="address" placeholder="Address" required>
        </div>
    </div>
    <div class="container">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-sm-1 mb-4"> 
            <textarea class="col col-lg-12 mt-3 form-control" name="message" rows="4" placeholder="Message" required></textarea>
        </div>
    </div>
    <div class="container">
        <div class="mb-3"> 
            <button class="btn btn-primary mt-3">Submit</button>
        </div>
    </div>
</form>
    <!-- Form Fields -->
</form>

    </div>
      </div>
    </div>
    
    </div>
  
 
          
   <!-- Before the closing </body> tag -->
<script src="{{asset('css/js/bootstrap.bundle.min.js') }}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>
@endsection