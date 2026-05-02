@extends('layouts.masterLayout')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@section('title') Bill / Invoice @endsection</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome Icons -->

    <style>
        .custom-size {
            width: 60px;
            height: 60px;
            object-fit: cover;
        }
        /* Hide buttons when printing or downloading the PDF */
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <!-- Print and Download Icons -->
        <div class="d-flex justify-content-between mb-4">
            <button class="btn btn-primary" id="print-btn">
            <a href="{{ route('invoice.download') }}" class="text-white text-decoration-none">
                <i class="fas fa-print"></i> Print
            </button>
            <button class="btn btn-success">
    <a href="{{ route('invoice.download', $order->id) }}" class="text-white text-decoration-none">
        <i class="fas fa-download"></i> Download PDF
    </a>
</button>
        </div>

        <!-- Bill Header -->
        <div class="row">
            <div class="col-6">
                <h3 class="fw-bold">Online Tailor Service</h3>
                <p>
                    Address: University road Askary Park Street 1 , Karachi, Pakistan<br>
                    Phone: +92 3000033681<br>
                    Email: nu@tailorservice.com
                </p>
            </div>
            <div class="col-6 text-end">
                <h4 class="fw-bold">Invoice</h4>
                <p>
                    Invoice #: <strong>{{$order->id}}</strong><br>
                    Date: <strong>{{$order->created_at}}</strong><br>
                    Due Date: <strong>{{$order->updated_at}}</strong>
                </p>
            </div>
        </div>
        <hr>

        <!-- Customer Information -->
        <div class="row">
            <div class="col-6">
                <h5 class="fw-bold">Customer Information</h5>
                <p>
                    Name: {{$order->name}}<br>
                    Phone: {{$order->phone}}<br>
                    Email: {{$order->email}}<br>
                    Address: {{$order->address}}<br>
                    Country: {{$order->country}}
                </p>
            </div>
            <div class="col-6 text-end">
                <h5 class="fw-bold">Order Details</h5>
                <p>
                    Order #: {{$order->id}}<br>
                    Order Date: {{$order->created_at}}<br>
                    Delivery Date: {{$order->updated_at}}
                </p>
            </div>
        </div>
        <hr>

        <!-- Bill Table with Product Images -->
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ $item->product_image }}" alt="{{ $item->product_name }}" class="img-thumbnail custom-size me-3">
                                    {{ $item->product_name }}
                                </div>
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>PKR{{ number_format($item->product_price, 2) }}</td>
                            <td>PKR{{ number_format($item->quantity * $item->product_price, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end fw-bold">Subtotal</td>
                            <td>PKR{{ number_format($subtotal, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end fw-bold">Tax (10%)</td>
                            <td>PKR{{ number_format($tax, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end fw-bold">Total</td>
                            <td>PKR{{ number_format($total, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Payment Details -->
        <div class="row mt-4">
            <div class="col-6">
                <h5 class="fw-bold">Payment Method</h5>
                <p>Cash on Delivery</p>
            </div>
            <div class="col-6 text-end">
                <h5 class="fw-bold">Signature</h5>
                <p>_______________________</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <p class="text-muted">
                    Thank you for choosing Online Tailor Service!<br>
                    For any inquiries, please contact us at +92 3000033681 or nu@tailorservice.com
                </p>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> <!-- jsPDF library -->


    
</body>

</html>
@endsection