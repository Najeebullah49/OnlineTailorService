<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{

public function store(Request $request)
{
       \DB::listen(function ($query) {
        \Log::info('SQL:', [$query->sql]);
        \Log::info('Bindings:', $query->bindings);
        \Log::info('Time:', [$query->time]);
    });
    // Decode JSON data from the input field
    $cartData = json_decode($request->order, true);

    // Separate total price from the product data
    $totalPrice = 0;
    $products = [];
    foreach ($cartData as $data) {
        if (isset($data['totalPrice'])) {
            $totalPrice = $data['totalPrice'];
        } else {
            $products[] = $data; // Add product details to the products array
        }
    }

    // Validate the input fields
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|numeric',
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'country' => 'required|string',
        'payment' => 'required|string',
       
    ]);

    // Save the order details in the database
    if(session()->has('id')){
$order = Order::create([
    'user_id' => session()->get('id'),
    'name' => $request->name,
    'email' => $request->email,
    'phone' => $request->phone,
    'address' => $request->address,
    'city' => $request->city,
    'country' => $request->country,
    'payment_method' => $request->payment,
    'total_price' => $totalPrice,
    'status' => 'pending',
    'productsize' => $products[0]['size']?? 'Medium',
]);
    } else {
        return redirect()->route('login');
    }

    // Check if $order is created
    if ($order) {
        $order_id = $order->id;

        foreach ($products as $product) {
            OrderItem::create([
                'order_id' => $order_id,
                'product_name' => $product['name'],
                'product_price' => $product['price'],
                'quantity' => $product['quantity'],
                'product_image' => $product['image'],
            ]);
        }
       // return dd($products[0]['size']);
      return redirect('checkout?order=success')->with('success', 'Order placed successfully!');
    }

    return back()->with('error', 'Failed to place the order.');
}

  


//showUserOrder
    public function showUserOrders()
    {
        // Fetch all orders with their associated order items
        $totalorders = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->select('orders.id as order_id', 'orders.name', 'orders.total_price', 'orders.status', 'orders.created_at', 'order_items.product_name')
            ->get();
    
        // Filter orders based on status
        $paidOrders = $totalorders->where('status', 'paid');
        $pendingOrders = $totalorders->where('status', 'pending');
        $cancelledOrders = $totalorders->where('status', 'cancelled');
    
        // Pass all data to the Blade template
        return view('displayOrder', compact('totalorders', 'paidOrders', 'pendingOrders', 'cancelledOrders'));
    }
    

    public function showUserPendingOrders()
    {
        // Fetch all orders with their associated order items
        $totalorders = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->select('orders.id as order_id', 'orders.name', 'orders.total_price', 'orders.status', 'orders.created_at', 'order_items.product_name')
            ->get();
    
        // Filter orders based on status
        $paidOrders = $totalorders->where('status', 'paid');
        $pendingOrders = $totalorders->where('status', 'pending');
        $cancelledOrders = $totalorders->where('status', 'cancelled');
    
        // Pass all data to the Blade template
        return view('userpendingorder', compact('totalorders', 'paidOrders', 'pendingOrders', 'cancelledOrders'));
    }
    // Inoice bill
    public function showInvoice()
    {
        // Get the logged-in user's ID from the session
        $userId = session()->get('id');
    
        // Fetch the most recent order for the logged-in user
        $order = Order::with(['orderItems'])->where('user_id', $userId)->latest()->first();
    
        // If no order is found, return an error or redirect
        if (!$order) {
            return redirect()->route('home')->with('error', 'No order found for this user');
        }
    
        // Calculate subtotal, tax, and total
        $subtotal = $order->orderItems->sum(function ($item) {
            return $item->quantity * $item->product_price;
        });
    
        // Calculate tax (10% of subtotal)
        $tax = $subtotal * 0.10;
    
        // Calculate total (subtotal + tax)
        $total = $subtotal + $tax;
    
        // Pass the data to the view
        return view('invoice', compact('order', 'subtotal', 'tax', 'total'));
    }
    
    
    // show all orders
public function showallInvoice()
{
    // Get the logged-in user's ID from the session
    $userId = session()->get('id');
    
    // Fetch all orders for the logged-in user
    $orders = Order::with(['orderItems'])->where('user_id', $userId)->get();
    
    // If no orders are found, return an error or redirect
    if ($orders->isEmpty()) {
        return redirect()->route('home')->with('error', 'No orders found for this user');
    }
    
    // Initialize variables for subtotal, tax, and total
    $subtotal = 0;
    $tax = 0;
    $total = 0;
    
    // Loop through each order and calculate subtotal, tax, and total
    foreach ($orders as $order) {
        $orderSubtotal = $order->orderItems->sum(function ($item) {
            return $item->quantity * $item->product_price;
        });

        // Add this order's subtotal to the overall subtotal
        $subtotal += $orderSubtotal;
    }

    // Calculate tax (10% of subtotal)
    $tax = $subtotal * 0.10;

    // Calculate total (subtotal + tax)
    $total = $subtotal + $tax;
    
    // Pass the data to the view
    return view('viewallorders', compact('orders', 'subtotal', 'tax', 'total'));
}



    //Download order
    public function downloadInvoice($orderId)
{
        
      
    
        // Fetch the most recent order for the logged-in user
        $order = Order::with(['orderItems'])->find($orderId)->latest()->first();
    
        // If no order is found, return an error or redirect
        if (!$order) {
            return redirect()->route('home')->with('error', 'No order found for this user');
        }
    
        // Calculate subtotal, tax, and total
        $subtotal = $order->orderItems->sum(function ($item) {
            return $item->quantity * $item->product_price;
        });
    
        // Calculate tax (10% of subtotal)
        $tax = $subtotal * 0.10;
    
        // Calculate total (subtotal + tax)
        $total = $subtotal + $tax;
    
        // Pass the data to the view
           return view('invoice.content', compact('order', 'subtotal', 'tax', 'total'));
}
//View
public function viewOrder($orderId)
{
   
    $order = Order::with(['orderItems'])->where('id', $orderId)->latest()->first();
    
    // If no order is found, return an error or redirect
    if (!$order) {
        return redirect()->route('home')->with('error', 'No order found for this user');
    }

    // Calculate subtotal, tax, and total
    $subtotal = $order->orderItems->sum(function ($item) {
        return $item->quantity * $item->product_price;
    });
   $delivery =  200;
    // Calculate tax (10% of subtotal)
    $tax = $subtotal * 0.10;

    // Calculate total (subtotal + tax)
    $total = $subtotal + $delivery + $tax;

    // Pass the data to the view
       return view('order_details', compact('order', 'subtotal','delivery', 'tax', 'total'));
}


//Delete
public function destroy($orderId)
{
    // Find the order by ID
    $order = Order::findOrFail($orderId);

    // Delete the order
    $order->delete();

    // Redirect with a success message
    return redirect()->route('displayDashboard')->with('success', 'Order deleted successfully.');
}

//Show chart

public function showCharts()
{
    $startOfMonth = now()->startOfMonth(); // January 1st, 2025
    $endOfMonth = now()->endOfMonth();     // January 31st, 2025

    // Initialize arrays
    $days = [];
    $totalRevenue = [];
    $totalOrders = [];

    // Loop through each day of the month
    for ($date = $startOfMonth; $date <= $endOfMonth; $date->addDay()) {
        $days[] = $date->format('d'); // Add day of the month (e.g., 01, 02)

        // Calculate total revenue and orders for the day
        $dailyRevenue = \App\Models\Order::whereDate('created_at', $date)->sum('total_price');
        $dailyOrders = \App\Models\Order::whereDate('created_at', $date)->count();

        $totalRevenue[] = $dailyRevenue; // Add to revenue array
        $totalOrders[] = $dailyOrders;   // Add to orders array
    }

    // Pass data to the view
    return view('admin.chart', [
        'days' => $days, // Days of January
        'totalRevenue' => $totalRevenue, // Revenue for each day
        'totalOrders' => $totalOrders,   // Orders for each day
    ]);
}

//Show Login User Data
public function showLoginUserOrders()
{
    $userId = session()->get('id'); // Get the currently logged-in user's ID

    // Fetch only the logged-in user's orders with their order items
    $totalorders = DB::table('orders')
        ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        ->where('orders.user_id', $userId) // Filter by logged-in user
        ->select(
            'orders.id as order_id',
            'orders.name',
            'orders.total_price',
            'orders.status',
            'orders.created_at',
            'order_items.product_name'
        )
        ->get();

    // Filter orders based on status
    $paidOrders = $totalorders->where('status', 'paid');
    $pendingOrders = $totalorders->where('status', 'pending');
    $cancelledOrders = $totalorders->where('status', 'cancelled');

    // Return the view with the filtered orders
    return view('displayOrder', compact('totalorders', 'paidOrders', 'pendingOrders', 'cancelledOrders'));
}
// View User Pendding
public function ViewUserPendding($orderId)
{
   
    $order = Order::with(['orderItems'])->where('id', $orderId)->latest()->first();
    
    // If no order is found, return an error or redirect
    if (!$order) {
        return redirect()->route('home')->with('error', 'No order found for this user');
    }

    // Calculate subtotal, tax, and total
    $subtotal = $order->orderItems->sum(function ($item) {
        return $item->quantity * $item->product_price;
    });
   $delivery =  200;
    // Calculate tax (10% of subtotal)
    $tax = $subtotal * 0.10;

    // Calculate total (subtotal + tax)
    $total = $subtotal + $delivery + $tax;

    // Pass the data to the view
       return view('admin/viewuserpendding', compact('order', 'subtotal','delivery', 'tax', 'total'));
}



}
