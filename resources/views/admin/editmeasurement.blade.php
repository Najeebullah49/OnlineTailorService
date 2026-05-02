@extends('layouts.masterLayout')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@section('title')
    Measurment 
    @endsection</title>
       <!-- In the <head> section -->
<link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet">

{{-- <link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"
          integrity=
"sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg=="crossorigin="anonymous" referrerpolicy="no-referrer" />
</head> --}}

<body>
 

    <div class="container"> 
    @if(session()->has('success'))
  <div class="alert alert-success text-center mx-auto" style="width: fit-content;">
    <p>{{ session()->get('success') }}</p>
  </div>
@endif

        <h1 class="mx-auto text-center my-4">Measurment Form</h1>
       <div class="row">
        <div class="col bg-light">
        <form action="{{ route('measurement.store')}}" method="POST">
    @csrf
    <!-- <form action="" method=""> -->
   
    <input type="hidden" name="user_id" value="{{ session()->get('id')}}">
    <div class="row row-cols-lg-4 row-cols-xlg-4 row-cols-xxlg-4 row-cols-md-2 row-cols-sm-1 row-cols-xsm-1">
        <div class="col-3 col-xm-12 mb-3">
            <Label for="name" class="form-label">Full Name</Label>
            <input type="text" placeholder="Enter Your Name" class="form-control" id="name" name="full_name">
        </div>
        <div class="col-3 mb-3">
            <Label for="email" class="form-label">Email</Label>
            <input type="email" placeholder="Enter Your Email" class="form-control" id="email" name="email">  
        </div>
        <div class="col-3 mb-3">
            <Label for="phoneNo" class="form-label">Phone No</Label>
            <input type="text" placeholder="Enter Your Phone No" class="form-control" id="phoneNo" name="phone_no">
        </div>
        <div class="col-3 mb-3">
            <Label for="address" class="form-label">Address</Label>
            <input type="text" placeholder="Enter Your Address" class="form-control" id="address" name="address">
        </div>
    </div>

    <div class="row mt-3 row-cols-lg-4 row-cols-xlg-4 row-cols-xxlg-4 row-cols-md-2 row-cols-sm-1 row-cols-xsm-1">
        <div class="col-3 mb-3">
            <Label for="length" class="form-label">Length</Label>
            <input type="text" placeholder="Enter Your Length" class="form-control" id="length" name="length">
        </div>
        <div class="col-3 mb-3">
            <Label for="width" class="form-label">Width</Label>
            <input type="text" placeholder="Enter Your Width" class="form-control" id="width" name="width">
        </div>
        <div class="col-3 mb-3">
            <Label for="chest" class="form-label">Chest</Label>
            <input type="text" placeholder="Enter Your Chest" class="form-control" id="chest" name="chest">
        </div>
        <div class="col-3 mb-3">
            <Label for="armLength" class="form-label">Arm Length</Label>
            <input type="text" placeholder="Enter Your Arm Length" class="form-control" id="armLength" name="arm_length">
        </div>
        <div class="col-3 mb-3">
            <Label for="shoulder" class="form-label">Shoulder</Label>
            <input type="text" placeholder="Enter Your Shoulder Length" class="form-control" id="shoulder" name="shoulder">
        </div>
        <div class="col-3  mb-3">
            <Label for="neck" class="form-label">Neck</Label>
            <input type="text" placeholder="Enter Your Neck" class="form-control" id="neck" name="neck">
        </div>
        <div class="col-3  mb-3">
            <Label for="kup" class="form-label">Kup</Label>
            <input type="number" id="kup" name="kup" placeholder="Enter Your Kup Length" class="form-control" autocomplete="off">

        </div>
        <div class="col-3  mb-3">
            <Label for="shalwarLength" class="form-label">Shalwar</Label>
            <input type="number" placeholder="Enter Your Shalwar Length" class="form-control" id="shalwarLength" name="shalwar_length">
        </div>
        <div class="col-3    mt-5">
            <Label for="paincha" class="form-label">Paincha</Label>
            <input type="number" placeholder="Enter Your Paincha Length" class="form-control" id="paincha" name="paincha">
        </div>
        <div class="col-3 my-3 mb-3">
            <Label class="form-label" for="arm_type_length">Arm Type</Label><br>
            
            <Label class="form-label mx-1">Kup</Label><input type="radio" name="arm_type" id="" value="Kup"> 
              <label class="form-label ms-3" for=""> Simple Arm</label><input type="radio" name="arm_type" id="" class="mx-1" value="Simple Arm"> 
              <input type="text" id="arm_type_length" name="arm_type_length"  placeholder="Length" class="form-control">
              
        </div>

        <div class="col-3 my-3 mb-3">
            <Label class="form-label" for="neckType">Neck Type</Label>
            <div>
                <label class="form-label mx-1" for="neckType">Collar</label> <input type="radio" name="neck_type"  id="collar"> 
                <label class="form-label ms-3" for="neckType">Sherwani</label> <input type="radio" name="neck_type" id="sherwani" class="mx-1"> 
                <input type="text" id="neckType"  placeholder="Length" class="form-control" name="neck_type_length">
            </div>
        </div>

        <div class="col-3 my-3 mb-3">
            <Label class="form-label">Pocket</Label><br>
                    <label for=""class="form-label">Front</label> <input type="checkbox" name="pocket[]" id="" value="Front Pocket" class="ms-1"> 
                   <label for=""class="form-label ms-3">Side</label><input type="checkbox" name="pocket[]"  id="" value="Side Pocket" class="ms-1">
                   <label for=""class="form-label ms-3">Shalwar</label> <input type="checkbox" name="pocket[]" value="Shalwar Pocket" id="" class="ms-1">  
                   <input type="number" placeholder="Quantity" class="form-control" name="pocket_quantity">
                   
        </div>
        <button class="btn btn-primary mt-5" type="submit">Submit</button>
     </div>
    </div> 
</form>
        </div>
       </div>
    </div>
                 
   <!-- Before the closing </body> tag -->
   <script src="{{asset('css/js/bootstrap.bundle.min.js') }}"></script>
   {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}
</body>
</html>
@endsection