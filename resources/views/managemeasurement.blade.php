@extends('layouts.masterLayout')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@section('title') Measurment @endsection</title>
    <!-- In the <head> section -->
    <link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        @if(session()->has('success'))
        <div class="alert alert-success text-center mx-auto mt-3" style="width: fit-content;">
            <p>{{ session()->get('success') }}</p>
        </div>
        @endif

        @if(isset($errorMessage))
            <div class="alert alert-danger text-center> mx-auto mt-3" style="width: fit-content;">
                {{ $errorMessage }}
            </div>
        @endif
        <h1 class="mx-auto text-center mb-4 mt-4">Measurment Form</h1>
        <div class="row">
            <div class="col bg-light">
                <form action="{{ route('measurements.update')}}" method="POST">
                    @csrf
                    <input type="hidden" name="userid" value="{{ session()->get('id') }}">

                    <!-- Personal Information Section -->
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" placeholder="Enter Your Name" class="form-control" id="name" name="name" value="{{ $showmeasurements->first() ? $showmeasurements->first()->name : 'Not Found' }}">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" placeholder="Enter Your Email" class="form-control" id="email" name="email" value="{{$showmeasurements->first() ? $showmeasurements->first()->email : 'Not Found'}}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="phoneNo" class="form-label">Phone No</label>
                            <input type="text" placeholder="Enter Your Phone No" class="form-control" id="phoneNo" name="phone" value="{{$showmeasurements->first() ? $showmeasurements->first()->phoneNo : 'Not Found' }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" placeholder="Enter Your Address" class="form-control" id="address" name="address" value="{{$showmeasurements->first() ? $showmeasurements->first()->address : 'Not Found' }}">
                        </div>
                    </div>

                    <!-- Measurement Section -->
                    <div class="row mt-3">
                        <div class="col-md-3 mb-3">
                            <label for="length" class="form-label">Length</label>
                            <input type="text" placeholder="Enter Your Length" class="form-control" id="length" name="length" value="{{ $showmeasurements->first() ? $showmeasurements->first()->length : 'Not Found' }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="width" class="form-label">Width</label>
                            <input type="text" placeholder="Enter Your Width" class="form-control" id="width" name="width" value="{{ $showmeasurements->first() ? $showmeasurements->first()->width : 'Not Found' }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="chest" class="form-label">Chest</label>
                            <input type="text" placeholder="Enter Your Chest" class="form-control" id="chest" name="chest" value="{{ $showmeasurements->first() ? $showmeasurements->first()->chest : 'Not Found' }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="armLength" class="form-label">Sleeve Length</label>
                            <input type="text" placeholder="Enter Your Arm Length" class="form-control" id="armLength" name="sleeve_length" value="{{ $showmeasurements->first() ? $showmeasurements->first()->sleeve_length : 'Not Found' }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="shoulder" class="form-label">Shoulder</label>
                            <input type="text" placeholder="Enter Your Shoulder Length" class="form-control" id="shoulder" name="shoulder" value="{{$showmeasurements->first() ? $showmeasurements->first()->shoulder : 'Not Found' }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="neck" class="form-label">Neck</label>
                            <input type="text" placeholder="Enter Your Neck" class="form-control" id="neck" name="neck" value="{{ $showmeasurements->first() ? $showmeasurements->first()->neck : 'Not Found' }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="kup" class="form-label">Cuff</label>
                            <input type="number" id="kup" name="cuff" placeholder="Enter Your Kup Length" class="form-control" autocomplete="off" value="{{ $showmeasurements->first() ? $showmeasurements->first()->cuff : 'Not Found' }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="shalwarLength" class="form-label">Shalwar Length</label>
                            <input type="number" placeholder="Enter Your Shalwar Length" class="form-control" id="shalwarLength" name="shalwarlength" value="{{ $showmeasurements->first() ? $showmeasurements->first()->shalwarLength : 'Not Found' }}">
                        </div>
                        <div class="col-md-3  mt-5">
                            <label for="paincha" class="form-label">Hem</label>
                            <input type="number" placeholder="Enter Your Paincha Length" class="form-control" id="paincha" name="hem" value="{{ $showmeasurements->first() ? $showmeasurements->first()->hem : 'Not Found' }}">
                        </div>
                        <!-- Sleeve Type Section -->
                        <div class="col-md-3 my-3 mb-3">
                            <label class="form-label" for="sleeve_type_length">Sleeve Type</label><br>
                            <label class="form-label mx-1">Cuff</label>
                            <input type="radio" name="sleeve_type" id="cuff" value="Cuff" {{ $showmeasurements->first() && $showmeasurements->first()->sleeve_type == 'Cuff' ? 'checked' : '' }}>
                            <label class="form-label ms-3" for="simple_sleeve">Simple Sleeve</label>
                            <input type="radio" name="sleeve_type" id="simple_sleeve" class="mx-1" value="Simple Sleeve" {{ $showmeasurements->first() && $showmeasurements->first()->sleeve_type == 'Simple Sleeve' ? 'checked' : '' }}>
                            <input type="text" id="arm_type_length" name="sleeve_type_length" placeholder="Length" class="form-control" value="{{ $showmeasurements->first() ? $showmeasurements->first()->sleeve_type_length : 'Not Found' }}">
                        </div>

                            <!-- Neck Type Section -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="neckType">Neck Type</label><br>
                            <label class="form-label mx-1" for="collar">Collar</label>
                            <input type="radio" name="neck_type" id="collar" value="Collar" {{ $showmeasurements->first() && $showmeasurements->first()->neck_type == 'Collar' ? 'checked' : '' }}>
                            <label class="form-label ms-3" for="sherwani">Sherwani</label>
                            <input type="radio" name="neck_type" id="sherwani" class="mx-1" value="Sherwani" {{ $showmeasurements->first() && $showmeasurements->first()->neck_type == 'Sherwani' ? 'checked' : '' }}>
                            <input type="text" id="neckType" placeholder="Length" class="form-control" name="neck_type_length" value="{{ $showmeasurements->first() ? $showmeasurements->first()->neck_type_length : 'Not Found' }}">
                        </div>
                  

                    <!-- Pocket Section -->
                  
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Pocket</label><br>
                            <label for="" class="form-label">Front</label>
                            <input type="checkbox" name="pocket[]" id="front" value="Front" {{ $showmeasurements->first() && in_array('Front', explode(',', $showmeasurements->first()->pocket ?? '')) ? 'checked' : '' }}  class="ms-1">
                            <label for="" class="form-label ms-3">Side</label>
                            <input type="checkbox" name="pocket[]" id="side" value="Side" {{ $showmeasurements->first() && in_array('Side', explode(',', $showmeasurements->first()->pocket)) ? 'checked' : '' }} class="ms-1">
                            <label for="" class="form-label ms-3">Shalwar</label>
                            <input type="checkbox" name="pocket[]" value="Shalwar" id="shalwar" {{ $showmeasurements->first() && in_array('Shalwar', explode(',', $showmeasurements->first()->pocket)) ? 'checked' : '' }} class="ms-1">
                            <input type="number" placeholder="Quantity" class="form-control" name="pocket_quantity" id="pocket_quantity" value="{{ $showmeasurements->first() ? $showmeasurements->first()->pocket_quantity : 'Not Found' }}">
                        </div>
                   
                    </div>
                    <!-- Button Section -->
                    <div class="row mb-3">
                        <div class="col-md-3 mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="{{asset('dist/js/bootstrap.bundle.min.js') }}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> -->

</body>
</html>
@endsection
