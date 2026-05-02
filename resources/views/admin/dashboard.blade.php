@extends('admin.adminlayouts.adminLayout')
@section('admincontent')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@section('title')
      Product
      @endsection</title>
   <!-- In the <head> section -->
<link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <link rel="stylesheet" href=
    "https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"
              integrity=
    "sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg=="
              crossorigin="anonymous" 
              referrerpolicy="no-referrer" />



</head>
<body>
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>

                        @if (session('success'))
                            <div class="alert alert-success text-center">
                                {{ session('success') }}
                            </div>
                        @endif


                          <!-- Dashboard -->
      <section id="dashboard" class="container-fluid py-4">
        <div class="row g-4">
          <div class="col-md-3">
            <div class="card bg-primary text-white">
              <div class="card-body">
                <h5>New Measurements</h5>
                <h2>{{ $totalM ?? '0' }}</h2>
               
                

              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card bg-success text-white">
              <div class="card-body">
                <h5>Orders</h5>
                <h2>{{ $totalO ?? '0' }}</h2>
               
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card bg-warning text-white">
              <div class="card-body">
                <h5>Customers</h5>
                <h2>{{ $totalC ?? '0' }}</h2>
              
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card bg-danger text-white">
              <div class="card-body">
                <h5>Pending Requests</h5>
                <h2>{{ $totalP ?? '0' }}</h2>
              </div>
            </div>
          </div>
        </div>
      </section>

    
            <div class="row">
                <!-- Area Chart for Total Revenue -->
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                           Revenue Area Chart 
                        </div>
                        <div class="card-body">
                            <canvas id="myAreaChart" width="100%" height="40"></canvas>
                        </div>
                    </div>
                </div>
                <!-- Bar Chart for Total Orders -->
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                           Orders  Bar Chart 
                        </div>
                        <div class="card-body">
                            <canvas id="myBarChart" width="100%" height="40"></canvas>
                        </div>
                    </div>
                </div>
            </div>
       

            <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Register Customers
                            </div>

                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Picture</th>
                                            <th>Type</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Picture</th>
                                            <th>Type</th>
                                            <th>Date</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    @forelse($customers as $customerd)
                                   
                        <tr>
                            
                            <td>{{$customerd->id}}</td>
                            <td>{{ $customerd->name }}</td>
                            <td>{{ $customerd->email }}</td>
                            <td> <img src="{{ asset('uploads/profiles/'.$customerd->picture ?: 'images/adminlogo1.png') }}" alt="" class="img-fluid mb-3 bg-primary" style="width:40px; height:40px;"></td>
                            <td>{{$customerd->type}}</td>
                            <td>{{ $customerd->created_at}}</td> 
                          
                        </tr>
                    @empty
                        <tr>
                            <td colspan="20" class="text-center text-muted">No data available</td>
                        </tr>
                    @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                </main>

            
            </div>
            </div>

            <script>
    // Inject data from the controller
    const days = @json($days); // Days (1, 2, ..., 30)
    const totalRevenue = @json($totalRevenue); // Revenue for each day
    const totalOrders = @json($totalOrders); // Orders for each day

    // Area Chart (Total Revenue)
    const ctxArea = document.getElementById('myAreaChart').getContext('2d');
    new Chart(ctxArea, {
        type: 'line',
        data: {
            labels: days, // X-axis: Days of January
            datasets: [{
                label: 'Total Revenue (Rs)',
                data: totalRevenue, // Revenue data
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: { title: { display: true, text: 'Days of January' } },
                y: { title: { display: true, text: 'Revenue (Rs)' }, beginAtZero: true }
            },
            plugins: {
                tooltip: {
                    enabled: false // Disable tooltips
                }
            }
        }
    });

    // Bar Chart (Total Orders)
    const ctxBar = document.getElementById('myBarChart').getContext('2d');
new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: @json($days), // X-axis: Days of January
        datasets: [{
            label: 'Total Orders',
            data: @json($totalOrders), // Orders data
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        scales: {
            x: { 
                title: { display: true, text: 'Days of January' } 
            },
            y: { 
                title: { display: true, text: 'Orders' },
                beginAtZero: true, // Start the Y-axis from 0
                ticks: {
                    stepSize: 1,    // Ensure the increments are in integers
                    precision: 0    // No floating-point numbers
                }
            }
        }
    }
});

</script>
        
   <!-- Before the closing </body> tag -->
   <script src="{{asset('css/js/bootstrap.bundle.min.js') }}"></script>
   {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}
</body>
</html>
@endsection