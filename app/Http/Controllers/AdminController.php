<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\UploadProduct;
use App\Models\Contact;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Measurement;
use App\Models\OptionalProduct;
class AdminController extends Controller
{
   
    public function addproduct(Request $data)
{
    // Validate the input for product and optional product
    $data->validate([
        'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
        'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
        'discription' => 'required|string|max:255',
        'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'category' => 'required|string',
        'file1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'file2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'file3' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'file4' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ], [
        'name.required' => 'The name field is required.',
        'name.regex' => 'The name may only contain letters and spaces.',
        'name.max' => 'The name may not be greater than 255 characters.',
        'price.regex' => 'The price must be a number in the format 40.00.',
        'discription.required' => 'The description field is required.',
        'discription.max' => 'The description may not be greater than 255 characters.',
    ]);

    // Begin a database transaction
    \DB::beginTransaction();

    try {
        // Store the main product
        $newproduct = new UploadProduct();
        $newproduct->name = $data->input('name');
        $newproduct->price = $data->input('price');
        $newproduct->discription = $data->input('discription');

        // Store the main product image
        if ($data->hasFile('file')) {
            $filename = time() . '_' . $data->file('file')->getClientOriginalName();
            $data->file('file')->move(public_path('admin/upload'), $filename); // Store image in 'admin/upload' directory
            $newproduct->picture = 'admin/upload/' . $filename; // Save relative path in the database
        }

        $newproduct->category = $data->input('category');

        if (!$newproduct->save()) {
            throw new \Exception('Failed to save the main product.');
        }

        // Store optional product data (if applicable)
        $optionalFiles = [];
        for ($i = 1; $i <= 4; $i++) {
            $fileKey = 'file' . $i;
            if ($data->hasFile($fileKey)) {
                $optionalFileName = time() . '_' . $fileKey . '_' . $data->file($fileKey)->getClientOriginalName();
                $data->file($fileKey)->move(public_path('admin/upload'), $optionalFileName);
                $optionalFiles[$fileKey] = $optionalFileName;
            } else {
                $optionalFiles[$fileKey] = null;
            }
        }

        // Save optional product data to the database (OptionalProduct table)
        OptionalProduct::create([
            'uploadproduct_id' => $newproduct->id,
            'category' => $data->input('category'),
            'optional_picture1' => $optionalFiles['file1'],
            'optional_picture2' => $optionalFiles['file2'],
            'optional_picture3' => $optionalFiles['file3'],
            'optional_picture4' => $optionalFiles['file4'],
        ]);

        // Commit the transaction
        \DB::commit();

        return redirect('uploadProduct')->with('uploaded', 'Product and optional products added successfully.');
    } catch (\Exception $e) {
        // Rollback the transaction on failure
        \DB::rollBack();
        \Log::error('Add Product Error: ' . $e->getMessage());

        return back()->with('error', 'Failed to add product: ' . $e->getMessage());
    }
}



/**
 * Helper function to store file in a specific folder.
 */



//show user contact data

public function showContacts()
{
    // Fetch all contact data
    $contacts = Contact::all();
    return view('admin.usercontact', compact('contacts'));
}
// Product List
 public function ProductList()
 {
     $productdata = UploadProduct::all(); // Fetch all records from the products table
     return view('admin.productlist', compact('productdata')); // Pass productdata to the view
 }
  

  public function countMeasurement()
    {
        // Count all rows in the 'measurements' table
        $cm = Measurement::count();


        // Pass both the count and the measurements to the view
        return view('admin.dashboard', compact('cm'));
    }

    // customer Details
    public function customersDetails()
    {
        // Count all rows in the 'measurements' table
        $customerDetails = User::all();


        // Pass both the count and the measurements to the view
        return view('admin.customers', compact('customerDetails'));
    }
    

    public function AdminproductDetails()
    {
        $productdata = UploadProduct::all(); // Fetch all records from the products table
        return view('admin.adminproductDetails', compact('productdata')); // Pass productdata to the view
        
    }

    

   

    public function showOrders()
    {
        $orders = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->select('orders.id as order_id', 'orders.name', 'orders.total_price','orders.status', 'orders.created_at', 'order_items.product_name')
            ->get();
     // Filter orders based on status
     $paidOrders = $orders->where('status', 'paid');
     $pendingOrders = $orders->where('status', 'pending');
     $cancelledOrders = $orders->where('status', 'cancelled');
 
     // Pass all data to the Blade template
     return view('admin.ordersdetails', compact('orders', 'paidOrders', 'pendingOrders', 'cancelledOrders'));
           
    }
    

    //Admin small profile
    public function adminSmallProfile(){
          $admindata  = User::where('id', session('id'))->first();
        return view('admin.adminlayouts.adminLayout',compact('admindata'));
    }
   
    
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status; // Get status from the form
        $order->save();
    
        return redirect()->back()->with('success', 'Order status updated successfully!');
    }
    

    public function pendingOrders()
    {
        $orders = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->select('orders.id as order_id', 'orders.name', 'orders.total_price','orders.status', 'orders.created_at', 'order_items.product_name')
            ->get();
     // Filter orders based on status
    //  $paidOrders = $orders->where('status', 'paid');
     $pendingOrders = $orders->where('status', 'pending');
    //  $cancelledOrders = $orders->where('status', 'cancelled');
 
     // Pass all data to the Blade template
    //  return view('admin.pendingorders', compact('orders', 'paidOrders', 'pendingOrders', 'cancelledOrders'));
    return view('admin.pendingorders', compact('pendingOrders'));
    return view('admin.pendingorders', compact('paidOrders'));
    return view('admin.pendingorders', compact('cancelledOrders'));
           
    }
    //paid
    public function paidOrders()
    {
        $orders = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->select('orders.id as order_id', 'orders.name', 'orders.total_price','orders.status', 'orders.created_at', 'order_items.product_name')
            ->get();
     // Filter orders based on status
     $paidOrders = $orders->where('status', 'paid');
    return view('admin.completedorders', compact('paidOrders'));  
    }

    public function cancelledOrders()
    {
        $orders = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->select('orders.id as order_id', 'orders.name', 'orders.total_price','orders.status', 'orders.created_at', 'order_items.product_name')
            ->get();
   
      $cancelledOrders = $orders->where('status', 'cancelled');
 
    return view('admin.cancelledOrders', compact('cancelledOrders'));
           
    }

    public function adminProfile()
    {
        $adminProfile = User::where('type', 'Admin')->first();
    
        return view('admin.adminprofile', compact('adminProfile'));
    }
    
    // Update admin name
    public function updateName(Request $request)
{
    // Validate the input
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    // Retrieve the admin user (assumes single admin)
    $admin = User::where('type', 'Admin')->first();

    // Update the name
    if ($admin) {
        $admin->name = $request->name;
        $admin->save();

        // Redirect with a success message
        return redirect()->back()->with('success', 'Admin name updated successfully!');
    }

    // Redirect with an error message if admin not found
    return redirect()->back()->with('error', 'Admin not found.');
}


//Update email
public function updateEmail(Request $request)
{
    // Validate the input
    $request->validate([
        'email' => 'required|email|unique:users,email',
    ]);

    // Retrieve the admin user (assumes single admin)
    $admin = User::where('type', 'Admin')->first();

    // Update the email
    if ($admin) {
        $admin->email = $request->email;
        $admin->save();

        // Redirect with a success message
        return redirect()->back()->with('success', 'Admin email updated successfully!');
    }

    // Redirect with an error message if admin not found
    return redirect()->back()->with('error', 'Admin not found.');
}

// Change admin picture
public function updatePicture(Request $request)
{
    // Validate the uploaded file
    $request->validate([
        'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
    ]);

    // Find the admin
    $admin = User::where('type', 'Admin')->first();

    if ($admin) {
        // Upload the new picture
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = public_path('uploads/profiles');
            
            // Ensure the directory exists
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            // Move the file to the directory
            $file->move($path, $filename);

            // Delete the old photo if it exists
            if ($admin->picture && file_exists(public_path('uploads/profiles/' . $admin->picture))) {
                unlink(public_path('uploads/profiles/' . $admin->picture));
            }

            // Save the new filename in the database
            $admin->picture = $filename;
            $admin->save();

            return redirect()->back()->with('success', 'Profile photo updated successfully!');
        }
    }

    return redirect()->back()->with('error', 'Admin not found.');
}

//Admin password change


public function changePassword(Request $request)
{
    // Validate the input
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed', // "confirmed" ensures new_password matches confirm_password
    ]);

    // Get the admin user (assumes single admin)
    $admin = User::where('type', 'Admin')->first();

    if ($admin) {
        // Check if the current password matches
        if (!Hash::check($request->current_password, $admin->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        // Update the password
        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return redirect()->back()->with('success', 'Password updated successfully!');
    }

    return redirect()->back()->with('error', 'Admin not found.');
}






public function updateProfile(Request $request)
{
    // Validate the input data
    $request->validate([
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . session('id'),
        'password' => 'nullable|confirmed|min:8',
    ]);

    // Retrieve the admin using the session ID
    $user = User::find(session('id'));  // Get the admin using the session ID

    // Check if the user exists
    if (!$user) {
        return redirect()->route('admin.manage.profile')->with('error', 'Admin not found.');
    }
    

    // Update profile picture if it's provided
    if ($request->hasFile('profile_picture')) {
        $imagePath = $request->file('profile_picture')->store('profiles', 'public');
        $user->picture = basename($imagePath);  // Store the image filename in the database
    }

    // Update name and email
    $user->name = $request->input('name');
    $user->email = $request->input('email');

    // Update password if provided
    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }

    $user->save();  // Save the updated profile data

    // Update session with the new name and email (if changed)
    session(['admin_name' => $user->name, 'admin_email' => $user->email]);

    return redirect()->route('admin.manage.profile')->with('success', 'Profile updated successfully.');
}

//Admin setting manage profile
public function settingupdateProfile(Request $request)
{
    // Validate the input data
    $request->validate([
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . session('id'),
        'password' => 'nullable|confirmed|min:8',
    ]);

    // Retrieve the admin using the session ID
    $user = User::find(session('admin_id'));  // Get the admin using the session ID

    // Check if the user exists
    if (!$user) {
        return redirect()->route('s_a_manageprofile')->with('error', 'Admin not found.');
    }

    // Update profile picture if it's provided
    if ($request->hasFile('profile_picture')) {
        $imagePath = $request->file('profile_picture')->store('profiles', 'public');
        $user->picture = basename($imagePath);  // Store the image filename in the database
    }

    // Update name and email
    $user->name = $request->input('name');
    $user->email = $request->input('email');

    // Update password if provided
    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }

    $user->save();  // Save the updated profile data

    // Update session with the new name and email (if changed)
    session(['admin_name' => $user->name, 'admin_email' => $user->email]);

    return redirect()->route('s_a_manageprofile')->with('success', 'Profile updated successfully.');
}

// Order view by id
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
       return view('admin/adminmanageprofile', compact('order', 'subtotal','delivery', 'tax', 'total'));
}


// Admin Register
public function AdminRegister(Request $data){

        // Validate the incoming request data
        $validator = Validator::make($data->all(), [
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255', // Only letters and spaces allowed
            'email' => 'required|string|email|max:255|unique:users',  // Valid email, unique
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
            ],         // Minimum 8 chars, must match confirmation
            'file' => 'nullable|image|max:2048',                      // Optional image, max size 2MB
        ], [
            'name.required' => 'The name field is required.',
            'name.regex' => 'The name may only contain letters and spaces.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'The password field is required.',
          
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.regex' => 'The password must include at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
            'file.image' => 'The file must be an image.',
            'file.max' => 'The image size must not exceed 2MB.',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->route('admin.register') // Use named route
                ->withErrors($validator)      // Pass validation errors back to the view
                ->withInput();                // Keep old input for re-entry
        }
    
        // Create a new user instance
        $newuser = new User();
        $newuser->name = $data->input('name');
        $newuser->email = $data->input('email');
        $newuser->password = Hash::make($data->input('password')); // Hash the password
    
        // Handle file upload if exists
        if ($data->hasFile('file')) {
            // If the user uploads a file, process and save it
            $fileName = time() . '_' . $data->file('file')->getClientOriginalName();
            $filePath = $data->file('file')->move(public_path('uploads/profiles/'), $fileName);
            $newuser->picture = $fileName;
        } else {
            // Assign a default image if no file is uploaded
            $newuser->picture = 'defaultprofile.png'; // Ensure this file exists in 'public/uploads/profiles/'
        }
        
    
        $newuser->type = "Admin";
    
        // Save the user and redirect with success message
        if ($newuser->save()) {
            return redirect()->route('login')->with('success', 'Congratulations! Your account is ready.');
        }
    
        // Return to sign-up page with a generic error message if saving fails
        return redirect()->route('admin.register')->with('wrong', 'Something went wrong. Please try again.');
   
}

// Show profits

public function showProfits(){
   
    $totalP = Order::where('status', 'pending')->count();
    $totalR = Order::Sum('total_price');
    $dailyRevenue = Order::whereDate('created_at', now())->sum('total_price');
    $weeklyRevenue = Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->sum('total_price');
    $monthlyRevenue = Order::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->sum('total_price');
    
    
// Chart section
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




  return view('admin.profits', compact('dailyRevenue', 'weeklyRevenue', 'monthlyRevenue',  'days', 'totalRevenue', 'totalOrders','totalR'));

  }

}
