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

    <link rel="stylesheet" href=
    "https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"
              integrity=
    "sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg=="
              crossorigin="anonymous" 
              referrerpolicy="no-referrer" /> 
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="{{asset('assets/plugins/fontawesome/js/all.min.js')}}"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="{{asset('assets/css/portal.css')}}">

</head> 

<body>   	
 

    
    <div class="app-wrapper mx-auto mt-5 col-lg-10 me-2">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-5">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Orders</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							    <div class="col-auto">
								    <form class="table-search-form row gx-1 align-items-center">
					                    <div class="col-auto">
					                        <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
					                    </div>
					                    <div class="col-auto">
					                        <button type="submit" class="btn app-btn-secondary">Search</button>
					                    </div>
					                </form>
					                
							    </div><!--//col-->
							    <div class="col-auto">
								    
								    <select class="form-select w-auto" >
										  <option selected value="option-1">All</option>
										  <option value="option-2">This week</option>
										  <option value="option-3">This month</option>
										  <option value="option-4">Last 3 months</option>
										  
									</select>
							    </div>
							  
						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
			   
			    
			    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
				    <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">All</a>
				    <a class="flex-sm-fill text-sm-center nav-link"  id="orders-paid-tab" data-bs-toggle="tab" href="#orders-paid" role="tab" aria-controls="orders-paid" aria-selected="false">Paid</a>
				    <a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab" href="#orders-pending" role="tab" aria-controls="orders-pending" aria-selected="false">Pending</a>
				    <a class="flex-sm-fill text-sm-center nav-link" id="orders-cancelled-tab" data-bs-toggle="tab" href="#orders-cancelled" role="tab" aria-controls="orders-cancelled" aria-selected="false">Cancelled</a>
				</nav>
				
				
				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">Order</th>
												<th class="cell">Product</th>
												<th class="cell">Customer</th>
												<th class="cell">Total</th>
												<th class="cell">Status</th>
												<th class="cell">Date</th>
												
												<th class="cell"></th>
											</tr>
										</thead>
										<tbody>
										@forelse($orders as $customerorders)
											<tr>
												<td class="cell">{{$customerorders->order_id}}</td>
												<td class="cell"><span class="truncate">{{$customerorders->product_name}}</span></td>
												<td class="cell">{{$customerorders->name}}</td>
												<td class="cell">{{$customerorders->total_price}}</td>
			
												<td class="cell">
                    <form action="{{ route('admin.orders.updateStatus', $customerorders->order_id) }}" method="POST">
                        @csrf
                        <select name="status" onchange="this.form.submit()">
                            <option value="pending" {{ $customerorders->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $customerorders->status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="cancelled" {{ $customerorders->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </form>
                </td>

												<td class="cell"><span>{{$customerorders->created_at}}</span><span class="note"></span></td>
												<!-- <td class="cell"><a class="btn-sm app-btn-secondary" href="{{-- route('orders.view', $customerorders->order_id ) --}}">View</a></td>
												<td class="cell"><a class="btn-sm app-btn-secondary" href="{{-- route('orders.destroy', $customerorders->order_id ) --}}">Delete</a></td>
											 -->
											</tr>
										
											@empty
                     					   <tr>
                           					 <td colspan="20" class="text-center text-muted">No data available</td>
                       					   </tr>
                   						    @endforelse
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						       
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
						<nav class="app-pagination">
							<ul class="pagination justify-content-center">
								<li class="page-item disabled">
									<a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
							    </li>
								<li class="page-item active"><a class="page-link" href="#">1</a></li>
								<li class="page-item"><a class="page-link" href="#">2</a></li>
								<li class="page-item"><a class="page-link" href="#">3</a></li>
								<li class="page-item">
								    <a class="page-link" href="#">Next</a>
								</li>
							</ul>
						</nav><!--//app-pagination-->
						
			        </div><!--//tab-pane-->
			        
					<div class="tab-pane fade" id="orders-paid" role="tabpanel" aria-labelledby="orders-paid-tab">
					    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
								    
							        <table class="table mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">Order</th>
												<th class="cell">Product</th>
												<th class="cell">Customer</th>
												<th class="cell">Date</th>
												<th class="cell">Status</th>
												<th class="cell">Total</th>
												<th class="cell"></th>
											</tr>
										</thead>
										<tbody>
											
                                        @forelse($paidOrders as $order)
                                        <tr>
												<td class="cell">{{ $order->order_id }}</td>
												<td class="cell"><span class="truncate">{{ $order->product_name }}</span></td>
												<td class="cell">{{ $order->name }}</td>
												<td class="cell"><span class="cell-data">{{ $order->created_at }}</span><span class="note">11:18 AM</span></td>
												<td class="cell"><span class="badge bg-success">{{ $order->status }}</span></td>
												<td class="cell">{{ $order->total_price }}</td>
												<td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
											</tr>
            @empty
                <tr>
                    <td colspan="6">No paid orders found.</td>
                </tr>
            @endforelse
											
										
		
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
			        </div><!--//tab-pane-->
			        
			        <div class="tab-pane fade" id="orders-pending" role="tabpanel" aria-labelledby="orders-pending-tab">
					    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">Order</th>
												<th class="cell">Product</th>
												<th class="cell">Customer</th>
												<th class="cell">Date</th>
												<th class="cell">Status</th>
												<th class="cell">Total</th>
												<th class="cell"></th>
											</tr>
										</thead>
										<tbody>
                                        @forelse($pendingOrders as $order)
                                        <tr>
												<td class="cell">{{ $order->order_id }}</td>
												<td class="cell"><span class="truncate">{{ $order->product_name }}</span></td>
												<td class="cell">{{ $order->name }}</td>
												<td class="cell"><span class="cell-data">{{ $order->created_at }}</span><span class="note">03:16 AM</span></td>
												<td class="cell"><span class="badge bg-warning">{{ $order->status }}</span></td>
												<td class="cell">{{ $order->total_price }}</td>
												<td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
											</tr>
            @empty
                <tr>
                    <td colspan="6">No pending orders found.</td>
                </tr>
            @endforelse
											
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
			        </div><!--//tab-pane-->
			        <div class="tab-pane fade" id="orders-cancelled" role="tabpanel" aria-labelledby="orders-cancelled-tab">
					    <div class="app-card app-card-orders-table mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">Order</th>
												<th class="cell">Product</th>
												<th class="cell">Customer</th>
												<th class="cell">Date</th>
												<th class="cell">Status</th>
												<th class="cell">Total</th>
												<th class="cell"></th>
											</tr>
										</thead>
										<tbody>
                                        @forelse($cancelledOrders as $order)
                                        <tr>
												<td class="cell">{{ $order->order_id }}</td>
												<td class="cell"><span class="truncate">{{ $order->product_name }}</span></td>
												<td class="cell">{{ $order->name }}</td>
												<td class="cell"><span class="cell-data">{{ $order->created_at }}</span><span class="note">04:23 PM</span></td>
												<td class="cell"><span class="badge bg-danger">{{ $order->status }}</span></td>
												<td class="cell">{{ $order->total_price }}</td>
												<td class="cell"><a class="btn-sm app-btn-secondary" href="#">View</a></td>
											</tr>
            @empty
                <tr>
                    <td colspan="6">No cancelled orders found.</td>
                </tr>
            @endforelse
											
											
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
			        </div><!--//tab-pane-->
				</div><!--//tab-content-->
				
				
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
	  
	    
    </div><!--//app-wrapper-->    					

 
    <!-- Javascript -->          
<script>
    document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('search-orders');
    const tableRows = document.querySelectorAll('tbody tr');

    searchInput.addEventListener('input', () => {
        const query = searchInput.value.toLowerCase();

        tableRows.forEach(row => {
            const columns = row.querySelectorAll('td');
            const matches = Array.from(columns).some(column =>
                column.textContent.toLowerCase().includes(query)
            );
            row.style.display = matches ? '' : 'none';
        });
    });
});

</script>
    <script src="{{asset('assets/plugins/popper.min.js')}}"></script> 
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script> 
    <!-- Page Specific JS -->
    <script src="{{asset('assets/js/app.js')}}"></script> 
	<script src="{{asset('css/js/bootstrap.bundle.min.js') }}"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> 

</body>
</html> 
@endsection
