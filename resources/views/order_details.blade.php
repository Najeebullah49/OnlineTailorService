@extends('layouts.masterLayout')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@section('title') View Order @endsection</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .custom-size {
            width: 60px;
            height: 60px;
            object-fit: cover;
        }

        /* Outer wrapper for each order */
        .order-block {
            border: 2px solid #dee2e6;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 40px;
            background: #fdfdfd;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .order-block h4 {
            color: #495057;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .card-header {
            background: linear-gradient(135deg, #6f42c1, #d63384);
            color: #fff;
            font-weight: 600;
        }

        .card {
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .order-total {
            font-size: 1.25rem;
            font-weight: bold;
            color: #d63384;
        }

        .badge {
            font-size: 0.9rem;
        }

        /* Divider line between sections */
        .section-divider {
            border-top: 2px dashed #dee2e6;
            margin: 25px 0;
        }
    </style>
</head>

<body>
<div class="container my-5">
    <h2 class="text-center mb-5">Order Details</h2>

    <!-- Wrapper for this order -->
    <div class="order-block">

        <!-- Order Summary -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-receipt me-2"></i> Order Summary
            </div>
            <div class="card-body">
                <p><strong>Order ID:</strong> {{$order->id}}</p>
                <p><strong>Order Date:</strong> {{$order->created_at}}</p>
                <p><strong>Status:</strong> <span class="badge bg-success">{{$order->status}}</span></p>
                <p><strong>Payment Method:</strong> {{$order->payment_method}}</p>
            </div>
        </div>

        <!-- Customer Details -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-person-circle me-2"></i> Customer Details
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{$order->name}}</p>
                <p><strong>Email:</strong> {{$order->email}}</p>
                <p><strong>Phone:</strong> {{$order->phone}}</p>
                <p><strong>Address:</strong> {{$order->address}}</p>
            </div>
        </div>

        <!-- Products Table -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-bag-check me-2"></i> Products
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                                <th>Size</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ $item->product_image }}" alt="{{ $item->product_name }}" class="img-thumbnail custom-size"></td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>PKR {{ number_format($item->product_price, 2) }}</td>
                                <td>PKR {{ number_format($item->quantity * $item->product_price, 2) }}</td>
                                <td>{{ $order->productsize }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Order Totals -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-cash-coin me-2"></i> Order Totals
            </div>
            <div class="card-body">
                <p><strong>Subtotal:</strong> PKR {{$subtotal}}</p>
                <p><strong>Shipping:</strong> PKR {{$delivery}}</p>
                <p><strong>Tax (10%):</strong> PKR {{$tax}}</p>
                <p class="order-total"><strong>Total:</strong> PKR {{$total}}</p>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-info-circle me-2"></i> Additional Information
            </div>
            <div class="card-body">
                <p><strong>Delivery Date:</strong> {{$order->updated_at}}</p>
                <p><strong>Notes:</strong> Please call before delivery.</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between mt-3">
            <a href="{{route('invoice.download', $order->id)}}" class="btn btn-primary">
                <i class="bi bi-download me-1"></i> Download Invoice
            </a>
        </div>

    </div>
</div>

<!-- Bootstrap Bundle -->
<script src="{{asset('css/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.js"></script>

</body>
</html>
@endsection
