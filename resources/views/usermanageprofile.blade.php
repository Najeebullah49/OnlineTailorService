@extends('layouts.masterLayout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <title>@section('title') User Manage Profile @endsection</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <div class="card">
                <div class="card-header text-center">
                <div class="d-flex justify-content-center mt-4">
    <div class="w-50">
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif
    </div>
</div>

                    <h3>Update Profile</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('usermanageprofile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            
                            <div class="d-flex justify-content-center">
                                <img class="profile-image bg-primary border border-secondry border-1" 
                                     src="{{ asset('uploads/profiles/' . $user->picture) }}" 
                                     alt="Profile Image" style="width: 150px; height: 150px; border-radius: 50%;">
                                     <div class="text-auto border bg-primary border-secondry rounded-circle" style="position:absolute; margin-top:125px; width:40px; height:40px; display:flex; aligns-item:center; justify-content:center;">
                            <label for="file-input" class="camera-icon bg-primary rounded-circle" style="cursor: pointer; width:40px; height:40px; display:flex; aligns-item:center; justify-content:center;">
                                                            <!-- Camera SVG icon -->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                                                                <path d="M8 1.5a3 3 0 1 0 3 3 3 3 0 0 0-3-3zM1 5.5a3.5 3.5 0 0 1 7 0h6a3.5 3.5 0 0 1 3.5 3.5v7a3.5 3.5 0 0 1-3.5 3.5H1a3.5 3.5 0 0 1-3.5-3.5v-7A3.5 3.5 0 0 1 1 5.5zM8 6.5a2 2 0 1 0 2 2 2 2 0 0 0-2-2z"/>
                                                            </svg>
                                                        </label>
                            </div>
                            </div>

                            <input type="file" name="profile_picture" id="file-input" accept="image/*" class="d-none" onchange="showSaveButton()">

                            <h5 class="text-center mb-2 mt-4">{{$user->name}}</h5>

                            @error('profile_picture')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter new password">
                            @error('password')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password">
                            @error('password_confirmation')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
