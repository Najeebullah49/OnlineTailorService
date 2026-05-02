@extends('layouts.masterLayout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@section('title') User Profile @endsection</title>
 
  <style>
    .profile-card {
      max-width: 400px;
      margin: auto;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      background-color: #fff;
    }

    @media (min-width: 992px) {
      .profile-card {
        max-width: 600px;
      }
      .profile-picture {
        width: 150px;
        height: 150px;
      }
    }

    .input-group-text {
      background-color: #f8f9fa;
      border-right: none;
    }

    .form-control {
      border-left: none;
    }

    /* Icon colors */
    .email-icon {
      color: rgb(93, 150, 237);
    }
    .password-icon {
      color: rgb(20, 253, 51);
    }
    .name-icon {
      color: orange;
    }

    /* Make all icons consistent size */
    .input-group-text svg {
      width: 20px;
      height: 20px;
    }

    .camera-icon svg {
        color: black;
        width: 30px;
        height: 30px;
    }

    #save-button {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
        font-weight: bold;
        padding: 5px 15px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s;
    }

    #save-button:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    #save-button {
        display: inline-block;
    }
.password-icon {
  width: 22px;
  height: 22px;
  color:  #6c757d; /* Bootstrap secondary */
}


</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
  <div class="profile-card text-center">
    <!-- Alerts -->
    <div class="d-flex justify-content-center mt-4">
      <div class="w-50">
          @if(session('success'))
              <div class="alert alert-success text-center">{{ session('success') }}</div>
          @elseif(session('error'))
              <div class="alert alert-danger text-center">{{ session('error') }}</div>
          @endif
      </div>
    </div>

    <!-- Profile Picture -->
    <div class="mb-2 position-relative">
      <form action="{{ route('update.profile.picture') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="d-flex justify-content-center">
          <img src="{{ asset('uploads/profiles/'.$user->picture) }}" alt="User Picture" class="img-fluid rounded-circle bg-primary" id="profile-picture" style="width: 150px; height: 150px; border-radius: 50%;">
          <div class="text-auto border bg-primary border-secondry rounded-circle" style="position:absolute; margin-top:125px; width:40px; height:40px; display:flex; align-items:center; justify-content:center;">
            <label for="file-input" class="camera-icon bg-primary rounded-circle" style="cursor: pointer; width:40px; height:40px; display:flex; align-items:center; justify-content:center;">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                  <path d="M8 1.5a3 3 0 1 0 3 3 3 3 0 0 0-3-3zM1 5.5a3.5 3.5 0 0 1 7 0h6a3.5 3.5 0 0 1 3.5 3.5v7a3.5 3.5 0 0 1-3.5 3.5H1a3.5 3.5 0 0 1-3.5-3.5v-7A3.5 3.5 0 0 1 1 5.5zM8 6.5a2 2 0 1 0 2 2 2 2 0 0 0-2-2z"/>
              </svg>
            </label>
          </div>
        </div>
        <input type="file" name="profile_picture" id="file-input" accept="image/*" class="d-none form-control @error('file') is-invalid @enderror" onchange="showSaveButton()"> 
        @error('file')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-sm btn-success d-none position-absolute" id="save-button" style="bottom: 10px; right: 10px;">Save</button>
      </form>
    </div>

    <!-- Display Name -->
    <h4 class="mb-4 mt-4" id="name-display"> {{ $user->name }}</h4>
   
    <!-- Name Edit -->
    <form class="col-12" method="POST" action="{{ route('updateUserName') }}">
      @csrf
      <div class="input-group mb-3">
        <span class="input-group-text">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person name-icon" viewBox="0 0 16 16">
            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            <path fill-rule="evenodd" d="M14 14s-1-1.5-6-1.5S2 14 2 14s1-4 6-4 6 4 6 4z"/>
          </svg>
        </span>
        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" id="name-input" name="name" value="{{ $user->name }}" disabled>
        <button type="button" class="btn btn-primary" id="edit-name-btn" onclick="enableEditing()">Edit</button>
        <button type="submit" class="btn btn-success d-none" id="save-name-btn">Save</button>
        @error('name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
      </div>
    </form>

    <!-- Email -->
    <form class="col-12" method="POST" action="{{ route('updateUserEmail') }}">
      @csrf
      <div class="input-group mb-3">
        <span class="input-group-text">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-envelope email-icon" viewBox="0 0 16 16">
            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1.586l-8 5.293-8-5.293V4z"/>
            <path d="M0 6.383l5.803 3.837a.5.5 0 0 0 .394.08h3.606a.5.5 0 0 0 .394-.08L16 6.383V12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6.383z"/>
          </svg>
        </span>
        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" id="email-input" name="email" value="{{ $user->email }}" disabled>
        <button type="button" class="btn btn-primary" id="edit-email-btn" onclick="enableEmailEditing()">Edit</button>
        <button type="submit" class="btn btn-success d-none" id="save-email-btn">Save</button>
        @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
      </div>
    </form>

    <!-- Security Section -->
    <div class="security-heading d-flex align-items-center justify-content-start">
      <div class="ms-3 my-3">
        <svg width="20" height="20" viewBox="0 0 16 16" fill="#fd7e14" xmlns="http://www.w3.org/2000/svg">
          <path d="M5.443 1.991a60.17 60.17 0 0 0-2.725.802..."/>
        </svg>
      </div>
      <h5 class="ms-4 mt-2">Security</h5>
    </div>

    <!-- Password -->
<form action="{{ route('user.updatePassword') }}" method="POST">
  @csrf

  <!-- New Password -->
  <div class="input-group mb-3">
    <span class="input-group-text bg-light">
      <i class="bi bi-lock-fill fs-5 text-secondary"></i>
    </span>
    <input type="password" 
           name="password" 
           class="form-control @error('password') is-invalid @enderror" 
           placeholder="New Password" 
           required>
    @error('password')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <!-- Confirm Password -->
  <div class="input-group mb-3">
    <span class="input-group-text bg-light">
      <i class="bi bi-lock-fill fs-5 text-secondary"></i>
    </span>
    <input type="password" 
           name="password_confirmation" 
           class="form-control" 
           placeholder="Confirm Password" 
           required>
  </div>

  <button type="submit" class="btn btn-primary">Update Password</button>
</form>

  </div>
</div>

<script>
  function showSaveButton() {
      document.getElementById('save-button').classList.remove('d-none');
  }
  function enableEditing() {
      document.getElementById("name-input").disabled = false;
      document.getElementById("save-name-btn").classList.remove("d-none");
  }
  function enableEmailEditing() {
      document.getElementById("email-input").disabled = false;
      document.getElementById("save-email-btn").classList.remove("d-none");
  }
</script>
<script src="{{asset('css/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
@endsection
