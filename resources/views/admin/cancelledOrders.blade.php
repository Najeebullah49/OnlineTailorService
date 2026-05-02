@extends('admin.adminlayouts.adminLayout')
@section('admincontent')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@section('title')
      Cancelled Order
      @endsection</title>
   <!-- In the <head> section -->
<link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet">



    <link rel="stylesheet" href=
    "https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"
              integrity=
    "sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg=="
              crossorigin="anonymous" 
              referrerpolicy="no-referrer" />

</head>
<body>
<div id="layoutSidenav_content" class="mt-5">
                <main class="mt-5">
                    <div class="container-fluid px-4">
                       <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                               Cancelled Orders 
                            </div>

                            <div class="card-body">
                                <table id="datatablesSimple">
                                <thead>
                                    <tr>
											
												<th class="cell">Product</th>
												<th class="cell">Customer</th>
												<th class="cell">Date</th>
												<th class="cell">Status</th>
												<th class="cell">Total</th>
												<th class="cell">View</th>
											</tr>
                                    </thead>
                                    <tfoot>
                                        
                                       <tr>
												
												<th class="cell">Product</th>
												<th class="cell">Customer</th>
												<th class="cell">Date</th>
												<th class="cell">Status</th>
												<th class="cell">Total</th>
												<th class="cell">View</th>
											</tr>
                                    </tfoot>
                                    <tbody>
                                    @forelse($cancelledOrders as $order)
                                        <tr>
												
												<td class="cell"><span class="truncate">{{ $order->product_name }}</span></td>
												<td class="cell">{{ $order->name }}</td>
												<td class="cell"><span class="cell-data">{{ $order->created_at }}</span><span class="note">04:23 PM</span></td>
												<td class="cell"><span class="badge bg-danger fs-6">{{ $order->status }}</span></td>
												<td class="cell">{{ $order->total_price }}</td>
                                               <td class="cell"><a class="btn-sm app-btn-secondary" href="{{ route('view.user.pendding', $order->order_id ) }}">View</a></td>
										
											</tr>
            @empty
                <tr>
                    <td colspan="6">No cancelled orders found.</td>
                </tr>
            @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>

            
            </div>
            </div>

                 
   <!-- Before the closing </body> tag -->
   <script src="{{asset('css/js/bootstrap.bundle.min.js') }}"></script>
   {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}

</body>
</html>
@endsection