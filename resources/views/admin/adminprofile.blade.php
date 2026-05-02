@extends('admin.adminlayouts.adminLayout')
@section('admincontent')
<!DOCTYPE html>
<html lang="en">
<head>
<title>@section('title')
      Admin Profile
      @endsection</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- App CSS -->  
   
    <link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link id="theme-style" href="{{asset('assets/css/portal.css') }}" rel="stylesheet">

    <!-- Custom Styling for Centering -->
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f6f9;
        }
        .container {
            max-width: 1200px;
            width: 100%;
        }
        .app-card-account {
            margin-bottom: 30px;
            border-radius: 8px;
        }
        .app-card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e0e0e0;
        }
        .app-card-body {
            padding: 25px;
        }
        .item {
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }
        .app-btn-secondary {
            background-color: #007bff;
            color: #ffffff;
        }
      
        .security-logo {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }

        .profile-image {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #ddd;
}

    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="app-page-title text-center mb-4">My Account</h1>
        @if (session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger text-center">
        {{ session('error') }}
    </div>
@endif

        <div class="row gy-4">
            <!-- Profile Card -->

            <div class="col-12 col-lg-6">
                <div class="app-card app-card-account shadow-sm">
                    <div class="app-card-header p-3">
                        <h4 class="app-card-title">Profile</h4>
                    </div>
                    <div class="app-card-body">
                        <!-- Profile Photo -->
                        <div class="item">
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
           
            <div>
                <img class="profile-image" src="{{ asset('uploads/profiles/' . $adminProfile->picture) }}" alt="Profile Image" style="width: 100px; height: 100px; border-radius: 50%;">
            </div>
        </div>
        <div class="col text-end">
            <!-- Button to trigger the form -->
            <form action="{{ route('admin.updatePicture') }}" method="POST" enctype="multipart/form-data" style="display: inline;">
                @csrf
                <input type="file" name="picture" accept="image/*" required style="display: none;" id="pictureInput">
                <button type="button" class="btn-sm app-btn-secondary" onclick="document.getElementById('pictureInput').click()">Change</button>
                <button type="submit" class="btn-sm btn-success">Save</button>
            </form>
        </div>
    </div>
</div>

                        <!-- Name -->
                        <div class="item">
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <strong> <div class="ms-3"> Name: {{ $adminProfile->name }}</div></strong>
            
        </div>
    
    </div>
    <div class="col text-end mt-3 ">
            <form action="{{ route('admin.updateName') }}" method="POST" style="">
                @csrf
                <input class="form-control " type="text" name="name" placeholder="New Name" required>
                <button type="submit" class="btn-sm app-btn-secondary mt-3 me-3">Change</button>
            </form>
        </div>
</div>

                        <!-- Email -->
                        <div class="item">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <strong><div class="ms-3">Email: {{ $adminProfile->email }}</div></strong>
                                    
                                </div>
                                <div class="col text-end">
                                <form class="form-control mt-3" action="{{ route('admin.updateEmail') }}" method="POST" style="display: inline;">
                @csrf
                <div> <input type="email" name="email" placeholder="New Email" class="form-control mb-3" required> </div>
                <button type="submit" class="btn-sm app-btn-secondary ms-3 mt-3">Change</button>
            </form>
                                </div>
                            </div>
                        </div>
                    </div>
               
                </div>
            </div>
        
            <!-- Security Card -->
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-account shadow-sm">
                    <div class="app-card-header p-3">
                        <h4 class="app-card-title">
                            <div class="app-icon-holder">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M5.443 1.991a60.17 60.17 0 0 0-2.725.802.454.454 0 0 0-.315.366C1.87 7.056 3.1 9.9 4.567 11.773c.736.94 1.533 1.636 2.197 2.093.333.228.626.394.857.5.116.053.21.089.282.11A.73.73 0 0 0 8 14.5c.007-.001.038-.005.097-.023.072-.022.166-.058.282-.111.23-.106.525-.272.857-.5a10.197 10.197 0 0 0 2.197-2.093C12.9 9.9 14.13 7.056 13.597 3.159a.454.454 0 0 0-.315-.366c-.626-.2-1.682-.526-2.725-.802C9.491 1.71 8.51 1.5 8 1.5c-.51 0-1.49.21-2.557.491zm-.256-.966C6.23.749 7.337.5 8 .5c.662 0 1.77.249 2.813.525a61.09 61.09 0 0 1 2.772.815c.528.168.926.623 1.003 1.184.573 4.197-.756 7.307-2.367 9.365a11.191 11.191 0 0 1-2.418 2.3 6.942 6.942 0 0 1-1.007.586c-.27.124-.558.225-.796.225s-.526-.101-.796-.225a6.908 6.908 0 0 1-1.007-.586 11.192 11.192 0 0 1-2.417-2.3C2.167 10.331.839 7.221 1.412 3.024A1.454 1.454 0 0 1 2.415 1.84a61.11 61.11 0 0 1 2.772-.815z"/>
  <path d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
</svg>

                            </div><!--//icon-holder-->
                            Security
                        </h4>
                    </div>
                    <div class="app-card-body">
                        <!-- Password -->
                        <div class="item">
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <strong>Password</strong>
            <div>••••••••</div>
        </div>
        <div class="col text-end">
            <!-- Trigger Modal -->
            <button class="btn-sm app-btn-secondary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change</button>
        </div>
    </div>
</div>

<!-- Password Change Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.changePassword') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <input type="password" name="current_password" class="form-control" id="currentPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" name="new_password" class="form-control" id="newPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirmPassword" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

                      
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