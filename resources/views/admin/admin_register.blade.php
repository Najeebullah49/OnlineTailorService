@extends('admin.adminlayouts.adminLayout')
@section('admincontent')
<!DOCTYPE html>
<html lang="en"> 
<head>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="favicon.ico"> 
  
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

</head> 

<body class="app app-signup p-0">   
    <div class="container"> 	
    <div class="row g-0 app-auth-wrapper">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">	
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="logo-icon me-2 mt-5" src="{{asset('images/logo12.png')}}" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-4">Sign up to Portal</h2>					
	
					<div class="auth-form-container text-start mx-auto">
                    <form class="mx-2 my-2" action="{{route('register.Admin')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-1">
        <label for="fullname" class="form-label">Full Name</label>
        <input 
            class="form-control @error('name') is-invalid @enderror" 
            type="text" 
            name="name" 
            id="fullname" 
            value="{{ old('name') }}" 
            required>
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-1">
        <label for="email" class="form-label">Email</label>
        <input 
            class="form-control @error('email') is-invalid @enderror" 
            type="email" 
            name="email" 
            id="email" 
            value="{{ old('email') }}" 
            required>
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-1">
        <label for="file" class="form-label">Picture</label>
        <input 
            class="form-control @error('file') is-invalid @enderror" 
            type="file" 
            name="file" 
            id="file">
        @error('file')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-1">
        <label for="password" class="form-label">Password</label>
        <input 
            class="form-control @error('password') is-invalid @enderror" 
            type="password" 
            name="password" 
            id="password" 
            required>
        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-1">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input 
            class="form-control" 
            type="password" 
            name="password_confirmation" 
            id="password_confirmation" 
            required>
    </div>

    <button class="btn btn-primary w-100 mt-3 mb-3" type="submit">Sign Up</button>
</form>
						
						<div class="auth-option text-center pt-5">Already have an account? <a class="text-link" href="{{route('login')}}" >Log in</a></div>
					</div><!--//auth-form-container-->	
					
					
				    
			    </div><!--//auth-body-->
		    
			    <footer class="app-auth-footer">
				    <div class="container text-center py-3">
				         <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
			      
				    </div>
			    </footer><!--//app-auth-footer-->	
		    </div><!--//flex-column-->   
	    </div><!--//auth-main-col-->
	    <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
		    <div class="auth-background-holder">			    
		    </div>
		    <div class="auth-background-mask">
                <img class="img img-fluid auth-background-mask" src="{{asset('admin/image/olive green.jpg')}}" alt="logo">
            </div>
		    
			    
		    </div><!--//auth-background-overlay-->
	    </div><!--//auth-background-col-->
    
    </div><!--//row-->

    </div>
</body>
</html> 

@endsection