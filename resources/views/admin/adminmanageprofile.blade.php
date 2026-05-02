@extends('admin.adminlayouts.adminLayout')
@section('admincontent')
<!DOCTYPE html>
<html lang="en">
<head>
<title>@section('title')
      Admin Manage Profile
      @endsection</title>
      <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
{{-- <link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"
          integrity=
"sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg=="
          crossorigin="anonymous" 
          referrerpolicy="no-referrer" /> --}}
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Update Profile</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.manage.profile') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <div class="d-flex justify-content-center">
                               <img 
    class="profile-image mb-3"
    src="{{ !empty($user->picture) && file_exists(public_path('uploads/profiles/' . $user->picture)) 
            ? asset('uploads/profiles/' . $user->picture) 
            : asset('images/profile/defaultprofile.png') }}"
    alt="Profile Image"
    style="width: 150px; height: 150px; border-radius: 50%;"
/>

                            </div>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                            @error('profile_picture')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password">
                            @error('password')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm new password">
                            @error('confirm_password')
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


   <!-- Before the closing </body> tag -->
   <script src="{{asset('css/js/bootstrap.bundle.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}
</body>
</html>
@endsection