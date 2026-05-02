<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand -->
        <a class="navbar-brand ps-3" href="{{route('displayDashboard')}}">Online Tailor Service</a>

        <!-- Sidebar Toggle -->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle"><i class="fas fa-bars" style="color:white;"></i></button>

        <!-- Navbar Search -->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>

    

        <!-- User Dropdown -->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-dark" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if(isset($admindata))

 <img
  src="{{ !empty($admindata->picture) && file_exists(public_path('uploads/profiles/'.$admindata->picture))
         ? asset('uploads/profiles/'.$admindata->picture)
         : asset('images/profile/defaultprofile.png') }}"
  class="rounded-circle img-fluid border border-primary bg-primary"
  style="width: 30px; height: 30px; object-fit: cover;"
  alt="Admin Profile"
  loading="lazy"
  onerror="this.onerror=null; this.src='{{ asset('images/profile/defaultprofile.png') }}';"
/>

                    @else
                        <i class="fas fa-user-circle" style="font-size: 30px;"></i>
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    @if(isset($admindata))
                        <li>
                         <img
  src="{{ !empty($admindata->picture) && file_exists(public_path('uploads/profiles/'.$admindata->picture))
         ? asset('uploads/profiles/'.$admindata->picture)
         : asset('images/profile/defaultprofile.png') }}"
  class="rounded-circle ms-3 img-fluid border border-primary bg-primary"
  style="width: 30px; height: 30px; object-fit: cover;"
  alt="Admin Profile"
  loading="lazy"
  onerror="this.onerror=null; this.src='{{ asset('images/profile/defaultprofile.png') }}';"
/>
                            <small class="me-3">{{ $admindata->name }}</small>
                            <small class="text-center mx-3 my-1">{{ $admindata->email }}</small>
                        </li>
                        <li><hr class="dropdown-divider" /></li>
                    @endif
                    <li><a class="dropdown-item" href="/adminprofile">Profile</a></li>
                    <li><a class="dropdown-item" href="/admin_register">Register</a></li>
                     <li><a class="dropdown-item" href="/adminusercontact">Contact History</a></li>
                    <!-- <li><a class="dropdown-item" href="{{--route('s_a_manageprofile')--}}">Settings</a></li> -->
                    <li><a class="dropdown-item" href="/adminlogout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Side Navigation -->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading text-white">Core</div>
                        <a class="nav-link text-white active" href="/displayDashboard">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                        <a class="nav-link text-white active" href="{{route('profits')}}">
                             <i class="fas fa-coins me-2"></i> Profits
                        </a>


                        <a class="nav-link text-white active collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <i class="fas fa-shopping-cart me-2"></i> Orders
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down" style="color: white;"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/pendingorders">Pending Orders</a>
                                <a class="nav-link" href="/cancelleddorders">Cancelled Orders</a>
                                <a class="nav-link" href="/completedorders">Completed Orders</a>
                                <a class="nav-link" href="/ordersdetails">Orders Details</a>
                            </nav>
                        </div>

                        <!-- Additional Menu Items -->
                        <a class="nav-link text-white active collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">
                            <i class="fas fa-box-open me-2"></i> Products
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down" style="color: white;"></i></div>
                        </a>
                        <div class="collapse" id="collapseProducts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="/uploadProduct"><i class="fas fa-upload me-2"></i> Product Upload</a>
                                <a class="nav-link" href="/productlist"><i class="fas fa-list me-2"></i> Product List</a>
                            </nav>
                        </div>
                        
                        <!-- Other links -->
                        <a class="nav-link text-white active" href="/measurementDetails">
                            <i class="fas fa-ruler me-2"></i> Measurements
                        </a>
                        <a class="nav-link text-white active" href="/customers">
                            <i class="fas fa-users me-2"></i> Customers
                        </a>
                        <!-- <a class="nav-link text-white active" href="#">
                            <i class="fas fa-bell me-2"></i> Notifications
                        </a> -->
                        <a class="nav-link text-white active" href="{{route('charts')}}">
                             <i class="fas fa-chart-bar me-2"></i> Chart
                        </a>
                        <a class="nav-link text-white active" href="/admin_register">
                          <i class="fas fa-file-alt me-2"></i> Page
                        </a>

                         <a class="nav-link text-white active" href="/adminusercontact">
                            <i class="fas fa-address-book me-2"></i> Contacts
                        </a>


                        <a class="nav-link text-danger active" href="/adminlogout">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer text-white">
                    <div class="small text-white">Owner</div>
                    Najeeb Ullah
                </div>
            </nav>
        </div>
        @yield('admincontent')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
</body>
</html>
