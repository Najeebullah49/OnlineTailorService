<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;
use App\Models\Measurement;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Carbon;
class DashboardController extends Controller
{
  
    
    public function showDashboard()
    {
        // Dashboard counts
        $totalM = Measurement::count(); // Total measurements
        $totalC = User::count(); // Total users
        $totalO = Order::count(); // Total orders
        $totalP = Order::where('status', 'pending')->count(); // Pending requests
    
        // Chart section
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();
    
        // Initialize arrays
        $days = [];
        $totalRevenue = [];
        $totalOrders = [];
    
        // Loop through each day of the month
        for ($date = $startOfMonth; $date <= $endOfMonth; $date->addDay()) {
            $days[] = $date->format('d'); // Day of the month (e.g., 01, 02)
    
            // Calculate daily revenue and orders
            $dailyRevenue = Order::whereDate('created_at', $date)->sum('total_price');
            $dailyOrders = Order::whereDate('created_at', $date)->count();
    
            $totalRevenue[] = $dailyRevenue;
            $totalOrders[] = $dailyOrders;
        }
    
        // Customers data
        $customers = User::where('type', 'Customer')->get();
    
        // Pass data to the view
        return view('admin.dashboard', compact(
            'totalM',
            'totalC',
            'totalO',
            'totalP',
            'days',
            'totalRevenue',
            'totalOrders',
            'customers' // Corrected here
        ));
    }
    


}
