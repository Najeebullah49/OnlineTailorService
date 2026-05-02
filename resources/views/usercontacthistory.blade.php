@extends('layouts.masterLayout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@section('title') Contacts @endsection</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
     <style>
        .contact-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            margin-bottom: 20px;
            overflow: hidden;
        }
        .contact-header {
            background: linear-gradient(135deg, #090a0aff, #6586b7ff);
            color: white;
            padding: 15px;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .contact-body {
            padding: 15px;
        }
        .contact-info {
            margin-bottom: 8px;
            font-size: 0.95rem;
            color: #495057;
        }
        .contact-info i {
            color: #0d6efd;
            width: 20px;
        }
        .message-box {
            background-color: #f8f9fa;
            border-left: 4px solid #0d6efd;
            padding: 12px;
            border-radius: 6px;
            font-size: 0.95rem;
            color: #212529;
        }
        .contact-footer {
            padding: 10px 15px;
            background-color: #f1f3f5;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>
<body>

@if(session('success'))
    <div class="container mt-3">
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    </div>
@endif

<div class="container mt-5">
    <h1 class="text-center mb-4">📩 Contact Submissions</h1>

    @foreach($contacts as $contact)
        <div class="card contact-card">
            <div class="contact-header">
                <i class="fa-solid fa-user"></i> {{ $contact->name }}
            </div>
            <div class="contact-body">
                <div class="contact-info"><i class="fa-solid fa-envelope"></i> {{ $contact->email }}</div>
                <div class="contact-info"><i class="fa-solid fa-location-dot"></i> {{ $contact->address }}</div>
                <div class="contact-info"><i class="fa-solid fa-clock"></i> {{ $contact->created_at->format('Y-m-d H:i') }}</div>
                <hr>
                <div class="message-box">
                    {{ $contact->message }}
                </div>
            </div>
            <div class="contact-footer">
                <span>📅 Submitted: {{ $contact->created_at->diffForHumans() }}</span>
              
            </div>
        </div>
    @endforeach
</div>

    <script src="{{ asset('css/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
@endsection