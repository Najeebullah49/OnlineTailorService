@extends('admin.adminlayouts.adminLayout')
@section('admincontent')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@section('title')
      Measurement
      @endsection</title>
      <style>
    table td {
        font-size: 0.95rem;
        vertical-align: middle;
        background-color: #fff;
    }
    table td strong {
        color: #0d6efd;
        font-weight: 600;
    }
</style>
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
   
<div class="container mt-5">

    <h2 class="text-center mb-5 fw-bold mt-5">📏 Measurement Details</h2>

    @forelse($measurementsDetails as $details)
        <div class="mb-5 p-4 border border-2 rounded-4 shadow-sm bg-light">
            <!-- User Info -->
            <div class="p-3 mb-4 rounded-3 text-white" style="background: linear-gradient(135deg, #007bff, #0056b3);">
                <div class="row">
                    <div class="col-md-4"><strong>ID:</strong> {{ $details->id }}</div>
                    <div class="col-md-4"><strong>User ID:</strong> {{ $details->user_id }}</div>
                    <div class="col-md-4"><strong>Name:</strong> {{ $details->name }}</div>
                    <div class="col-md-4"><strong>Email:</strong> {{ $details->email }}</div>
                    <div class="col-md-4"><strong>Phone No:</strong> {{ $details->phoneNo }}</div>
                    <div class="col-md-4"><strong>Address:</strong> {{ $details->address }}</div>
                </div>
            </div>

            <!-- Measurement Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center">
                    <tbody>
                        <tr>
                            <td><strong>Length</strong><br>{{ $details->length }}</td>
                            <td><strong>Width</strong><br>{{ $details->width }}</td>
                            <td><strong>Chest</strong><br>{{ $details->chest }}</td>
                        </tr>
                        <tr>
                            <td><strong>Arm Length</strong><br>{{ $details->sleeve_length }}</td>
                            <td><strong>Shoulder</strong><br>{{ $details->shoulder }}</td>
                            <td><strong>Neck</strong><br>{{ $details->neck }}</td>
                        </tr>
                        <tr>
                            <td><strong>Cuff</strong><br>{{ $details->cuff }}</td>
                            <td><strong>Shalwar Length</strong><br>{{ $details->shalwarLength }}</td>
                            <td><strong>Hem</strong><br>{{ $details->hem }}</td>
                        </tr>
                        <tr>
                            <td><strong>Neck Type</strong><br>{{ $details->neck_type }}</td>
                            <td><strong>Neck Type Length</strong><br>{{ $details->neck_type_length }}</td>
                            <td><strong>Arm Type</strong><br>{{ $details->sleeve_type }}</td>
                        </tr>
                        <tr>
                            <td><strong>Arm Type Length</strong><br>{{ $details->sleeve_type_length }}</td>
                            <td>
                                <strong>Pocket</strong><br>
                                @php
                                    $pocketData = json_decode($details->pocket, true);
                                @endphp
                                {{ is_array($pocketData) ? implode(', ', $pocketData) : 'N/A' }}
                            </td>
                            <td><strong>Pocket Quantity</strong><br>{{ $details->pocket_quantity }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @empty
        <div class="alert alert-warning text-center">🚫 No measurement details found.</div>
    @endforelse

</div>



      <!-- Before the closing </body> tag -->
      <script src="{{asset('css/js/bootstrap.bundle.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}
</body>
</html>
@endsection
