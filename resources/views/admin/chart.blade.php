@extends('admin.adminlayouts.adminLayout')
@section('admincontent')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@section('title') Charts @endsection</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div id="layoutSidenav_content">
        <main class="mt-5">
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
        </main>
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


    <script src="{{ asset('css/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
@endsection
