@extends('admin.adminlayouts.adminLayout')
@section('admincontent')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@section('title')
    View Order
    @endsection</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .custom-size {
            width: 60px;
            height: 60px;
            object-fit: cover;
        }

        .card-header {
            background-color:rgb(243, 194, 234);;
            color: white;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .order-total {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .badge {
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
<div class="container my-5">
    <h2 class="text-center mb-4 mt-5">Order Details</h2>

    <!-- Order Summary -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Order Summary</h5>
        </div>
        <div class="card-body">
            <p><strong>Order ID:</strong> {{$order->id}}</p>
            <p><strong>Order Date:</strong> {{$order->created_at}}</p>
            <p><strong>Status:</strong> <span class="badge bg-success">{{$order->status}}</span></p>
            <p><strong>Payment Method:</strong> {{$order->payment_method}}</p>
        </div>
    </div>

    <!-- Customer Details -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Customer Details</h5>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{$order->name}}</p>
            <p><strong>Email:</strong> {{$order->email}}</p>
            <p><strong>Phone:</strong> {{$order->phone}}</p>
            <p><strong>Address:</strong> {{$order->address}}</p>
        </div>
    </div>

    <!-- Products Table -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Products</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
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
                          <td> {{ $order->productsize }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Order Totals -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Order Totals</h5>
        </div>
        <div class="card-body">
            <p><strong>Subtotal:</strong> PKR {{$subtotal}}</p>
            <p><strong>Shipping:</strong> PKR {{$delivery}}</p>
            <p><strong>Tax (10%):</strong> PKR {{$tax}}</p>
            <p class="order-total"><strong>Total:</strong> PKR {{$total}}</p>
        </div>
    </div>

    <!-- Additional Information -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Additional Information</h5>
        </div>
        <div class="card-body">
            <p><strong>Delivery Date:</strong> {{$order->updated_at}}</p>
            <p><strong>Notes:</strong> Please call before delivery.</p>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="d-flex justify-content-between">
        <a href="{{route('invoice.download', $order->id)}}" class="btn btn-primary">Download Invoice</a>
        <!-- <button class="btn btn-danger">Cancel Order</button> -->
    </div>
</div>
  <!-- Before the closing </body> tag -->
  <script src="{{asset('css/js/bootstrap.bundle.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}


</body>
</html>
@endsection
