@extends('admin.adminlayouts.adminLayout')
@section('admincontent')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@section('title')
      Eech User Measurement
      @endsection</title>
   <!-- In the <head> section -->
<link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet">



    <link rel="stylesheet" href=
    "https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"
              integrity=
    "sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg=="
              crossorigin="anonymous" 
              referrerpolicy="no-referrer" />
              <style>
    .card-header {
        font-size: 1rem;
        letter-spacing: 0.5px;
    }
    table th, table td {
        font-size: 0.9rem;
        word-break: break-word;
    }
    .row strong {
        color: #555;
    }
    @media (max-width: 768px) {
        .table th, .table td {
            font-size: 0.85rem;
        }
    }
</style>

</head>
<body>
<div class="container  mt-5">
    <h2 class="text-center mb-3 fw-bold mt-3"> User Measurements</h2>

    @forelse($eachUserMeasurement as $m)
    <div class="card shadow-sm mb-4 border-0 rounded-3">
        <div class="card-header bg-primary text-white fw-bold">
            Measurement Record #{{ $m->id }}
        </div>
        <div class="card-body">

            <!-- User Basic Info -->
            <div class="mb-4">
                <div class="row g-3">
                    <div class="col-md-4 col-sm-6">
                        <strong>Id:</strong> {{ $m->id }}
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <strong>User Id:</strong> {{ $m->user_id }}
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <strong>Name:</strong> {{ $m->name }}
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <strong>Email:</strong> {{ $m->email }}
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <strong>Phone No:</strong> {{ $m->phoneNo }}
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <strong>Address:</strong> {{ $m->address }}
                    </div>
                </div>
            </div>

            <!-- Measurements Table -->
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <tbody>
                        <tr class="table-light fw-semibold">
                            <th>Length</th>
                            <th>Width</th>
                            <th>Chest</th>
                        </tr>
                        <tr>
                            <td>{{ $m->length }}</td>
                            <td>{{ $m->width }}</td>
                            <td>{{ $m->chest }}</td>
                        </tr>

                        <tr class="table-light fw-semibold">
                            <th>Arm Length</th>
                            <th>Shoulder</th>
                            <th>Neck</th>
                        </tr>
                        <tr>
                            <td>{{ $m->sleeve_length }}</td>
                            <td>{{ $m->shoulder }}</td>
                            <td>{{ $m->neck }}</td>
                        </tr>

                        <tr class="table-light fw-semibold">
                            <th>Kup</th>
                            <th>Shalwar Length</th>
                            <th>Hem</th>
                        </tr>
                        <tr>
                            <td>{{ $m->cuff }}</td>
                            <td>{{ $m->shalwarLength }}</td>
                            <td>{{ $m->hem }}</td>
                        </tr>

                        <tr class="table-light fw-semibold">
                            <th>Neck Type</th>
                            <th>Neck Type Length</th>
                            <th>Arm Type</th>
                        </tr>
                        <tr>
                            <td>{{ $m->neck_type }}</td>
                            <td>{{ $m->neck_type_length }}</td>
                            <td>{{ $m->sleeve_type }}</td>
                        </tr>

                        <tr class="table-light fw-semibold">
                            <th>Arm Type Length</th>
                            <th>Pocket</th>
                            <th>Pocket Quantity</th>
                        </tr>
                        <tr>
                            <td>{{ $m->sleeve_type_length }}</td>
                            <td>
                                @php
                                    $pocketData = json_decode($m->pocket, true);
                                @endphp
                                {{ is_array($pocketData) ? implode(', ', $pocketData) : 'N/A' }}
                            </td>
                            <td>{{ $m->pocket_quantity }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @empty
        <div class="alert alert-warning text-center fw-semibold">No measurements found</div>
    @endforelse
</div>



      <!-- Before the closing </body> tag -->
      <script src="{{asset('css/js/bootstrap.bundle.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}
</body>
</html>
@endsection
