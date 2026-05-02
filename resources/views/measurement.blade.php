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
  <div class="alert alert-success text-center mx-auto mt-3" style="width: fit-content;">
    <p>{{ session()->get('success') }}</p>
  </div>
@endif
<h4 class=" my-4 text-primary text-center"><a href="https://youtu.be/3Wpw380aUiY?si=dv6AXUjNud_9SJmv">Watch Measurement Video</a></h4>
        <h1 class="mx-auto text-center mt-4">Measurment Form</h1>
       <div class="row">
        <div class="col bg-light">
        <form action="{{ route('measurement.store')}}" method="POST">
    @csrf
    <input type="hidden" name="user_id" value="{{ session()->get('id')}}">
    <div class="row row-cols-lg-4 row-cols-md-2 row-cols-sm-12">
        <div class="col-12 col-xm-12 mb-3 ">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" placeholder="Enter Your Name" class="form-control @error('full_name') is-invalid @enderror" id="name" name="full_name" value="{{ old('full_name') }}" required>
            @error('full_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-12 mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" placeholder="Enter Your Email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-12 mb-3">
            <label for="phoneNo" class="form-label">Phone No</label>
            <input type="text" placeholder="Enter Your Phone No" class="form-control @error('phone_no') is-invalid @enderror" id="phoneNo" name="phone_no" value="{{ old('phone_no') }}">
            @error('phone_no')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-12 mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" placeholder="Enter Your Address" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}">
            @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="row  row-cols-lg-4 row-cols-md-2 row-cols-sm-1">
        @foreach (['length', 'width', 'chest','shoulder', 'sleeve_length', 'neck', 'cuff', 'shalwar_length', 'hem'] as $field)
            <div class="col-12 mt-5">
                <label for="{{ $field }}" class="form-label">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                <input type="text" placeholder="Enter Your {{ ucfirst(str_replace('_', ' ', $field)) }}" class="form-control @error($field) is-invalid @enderror" id="{{ $field }}" name="{{ $field }}" value="{{ old($field) }}">
                @error($field)
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        @endforeach

        <div class="col-12 my-3 mb-3">
            <label class="form-label" for="sleeve_type_length">Sleeve Type</label><br>
            <label class="form-label mx-1">Cuff</label>
            <input type="radio" name="sleeve_type" id="" value="Cuff" {{ old('sleeve_type') == 'Cuff' ? 'checked' : '' }}>
            <label class="form-label ms-3" for="">Simple Sleeve</label>
            <input type="radio" name="arm_type" id="" value="Simple Arm" {{ old('sleeve_type') == 'Simple Sleeve' ? 'checked' : '' }}>
            <input type="text" id="sleeve_type_length" name="sleeve_type_length" placeholder="Length" class="form-control @error('sleeve_type_length') is-invalid @enderror" value="{{ old('sleeve_type_length') }}">
            @error('sleeve_type_length')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="col-12 my-3 mb-3">
            <label class="form-label" for="neckType">Neck Type</label>
            <div>
                <label class="form-label mx-1" for="neckType">Collar</label>
                <input type="radio" name="neck_type" id="collar" value="Collar" {{ old('neck_type') == 'Collar' ? 'checked' : '' }}>
                <label class="form-label ms-3" for="neckType">Sherwani</label>
                <input type="radio" name="neck_type" id="sherwani" value="Sherwani" {{ old('neck_type') == 'Sherwani' ? 'checked' : '' }}>
                <input type="text" id="neckType" placeholder="Length" class="form-control @error('neck_type_length') is-invalid @enderror" name="neck_type_length" value="{{ old('neck_type_length') }}">
                @error('neck_type_length')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12 my-3 mb-3">
            <label class="form-label">Pocket</label><br>
            @foreach (['Front', 'Side', 'Shalwar'] as $pocket)
                <label for="" class="form-label">{{ $pocket }}</label>
                <input type="checkbox" name="pocket[]" id="" value="{{ $pocket }}" {{ in_array($pocket, old('pocket', [])) ? 'checked' : '' }} class="ms-1">
            @endforeach
            <input type="number" placeholder="Quantity" class="form-control @error('pocket_quantity') is-invalid @enderror" name="pocket_quantity" value="{{ old('pocket_quantity') }}">
            @error('pocket_quantity')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <button class="btn btn-primary mt-3 mb-4" type="submit">Submit</button>
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