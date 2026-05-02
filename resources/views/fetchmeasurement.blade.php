@extends('layouts.masterLayout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@section('title') Fetch Measurement @endsection</title>
    <!-- Bootstrap 5 CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
    table td {
        font-size: 0.95rem;
        vertical-align: middle;
        background-color: #fff;
    }
    table td strong {
        color: #6f42c1;
        font-weight: 600;
    }
</style>
</head>
<body>
<div class="container mt-5">

    <h2 class="text-center mb-5 fw-bold">📏 Measurement Details</h2>

    @forelse($measurements as $measurement)
        <div class="mb-5 p-4 border border-2 rounded-4 shadow-sm bg-light">
            <!-- User Info -->
            <div class="p-3 mb-4 rounded-3 text-white bg-secondary">
                <div class="row">
                    <div class="col-md-4"><strong>ID:</strong> {{ $measurement->id }}</div>
                    <div class="col-md-4"><strong>User ID:</strong> {{ $measurement->user_id ?? 'N/A' }}</div>
                    <div class="col-md-4"><strong>Name:</strong> {{ $measurement->name }}</div>
                    <div class="col-md-4"><strong>Email:</strong> {{ $measurement->email }}</div>
                    <div class="col-md-4"><strong>Phone No:</strong> {{ $measurement->phoneNo }}</div>
                    <div class="col-md-4"><strong>Address:</strong> {{ $measurement->address }}</div>
                </div>
            </div>

            <!-- Measurement Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center">
                    <tbody>
                        <tr>
                            <td><strong>Length</strong><br>{{ $measurement->length }}</td>
                            <td><strong>Width</strong><br>{{ $measurement->width }}</td>
                            <td><strong>Chest</strong><br>{{ $measurement->chest }}</td>
                        </tr>
                        <tr>
                            <td><strong>Arm Length</strong><br>{{ $measurement->sleeve_length }}</td>
                            <td><strong>Shoulder</strong><br>{{ $measurement->shoulder }}</td>
                            <td><strong>Neck</strong><br>{{ $measurement->neck }}</td>
                        </tr>
                        <tr>
                            <td><strong>Cuff</strong><br>{{ $measurement->cuff }}</td>
                            <td><strong>Shalwar Length</strong><br>{{ $measurement->shalwarLength }}</td>
                            <td><strong>Hem</strong><br>{{ $measurement->hem }}</td>
                        </tr>
                        <tr>
                            <td><strong>Neck Type</strong><br>{{ $measurement->neck_type }}</td>
                            <td><strong>Neck Type Length</strong><br>{{ $measurement->neck_type_length }}</td>
                            <td><strong>Arm Type</strong><br>{{ $measurement->sleeve_type }}</td>
                        </tr>
                        <tr>
                            <td><strong>Arm Type Length</strong><br>{{ $measurement->sleeve_type_length }}</td>
                            <td>
                                <strong>Pocket</strong><br>
                                @php
                                    $pocketData = json_decode($measurement->pocket, true);
                                @endphp
                                {{ is_array($pocketData) ? implode(', ', $pocketData) : 'N/A' }}
                            </td>
                            <td><strong>Pocket Quantity</strong><br>{{ $measurement->pocket_quantity }}</td>
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
