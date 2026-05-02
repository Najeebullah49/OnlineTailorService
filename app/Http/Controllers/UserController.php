<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\UploadProduct;
use App\Models\Contact;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Measurement;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function registerUser(Request $data)
    {
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
            'file' => 'nullable|image|max:5120',                      // Optional image, max size 2MB
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
            'file.max' => 'The image size must not exceed 5MB.',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->route('signUp') // Use named route
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
        
    
        $newuser->type = "Customer";
    
        // Save the user and redirect with success message
        if ($newuser->save()) {
            return redirect()->route('login')->with('success', 'Congratulations! Your account is ready.');
        }
    
        // Return to sign-up page with a generic error message if saving fails
        return redirect()->route('signUp')->with('wrong', 'Something went wrong. Please try again.');
    }
    

    public function loginUser(Request $data)
    {
        $user = User::where('email', $data->input('email'))->first();

        if ($user && Hash::check($data->input('password'), $user->password)) {
            session()->put('id', $user->id);
            session()->put('name', $user->name);
            session()->put('email', $user->email);
            session()->put('role', $user->type ?? 'Customer');

            if ($user->type == 'Customer') {
                return redirect()->route('home'); // Use named route
            }

            else{
                session()->put('admin_id', $user->id);
            return redirect()->route('displayDashboard');
            }
        }

        return redirect()->route('login')->with('error', 'Email or password is incorrect.');
    }

    public function logout(Request $request)
    {
          // Forget only user-specific session values
    $request->session()->forget(['id', 'name', 'email', 'role']);

  

        // Redirect to the login page
        return redirect()->route('login');
    }
    

    // Display Product
    public function displayProduct()
    {
        $productdata = UploadProduct::where('category', 'Custom')
        ->with('optionalProducts') // Eager load the related UploadOptional data
        ->get();
        

return view('product', compact('productdata')); // Pass productdata to the view
    }
//reated product
public function displayProductDetails()
{
    $productdata = UploadProduct::all(); // Fetch all records from the products table
    return view('productDetails', compact('productdata')); // Pass productdata to the view
}

public function displayReadyMade()
{
    $productdata = UploadProduct::where('category', 'ReadyMade')
                                ->with('optionalProducts') // Eager load the related UploadOptional data
                                ->get();
    return view('ready_made', compact('productdata')); // Pass productdata to the view
}


    //Show profile
    public function profile()
    {
        // Retrieve the 'id' from the session
    $userId = session()->get('id');

    // Fetch the user details where the 'id' matches the session stored 'id'
    $user = User::find($userId);

    // Check if the user is found
    if ($user) {
        // Pass the user data to the view
        return view('layouts.masterLayout', compact('user'));
    } else {
        // Handle case where the user doesn't exist
        return redirect()->route('login')->with('error', 'User not found');
    }
    }



    public function myprofile()
    {
        // Retrieve the 'id' from the session
    $userpId = session()->get('id');

    // Fetch the user details where the 'id' matches the session stored 'id'
    $userp = User::find($userpId);

    // Check if the user is found
    if ($userp) {
        // Pass the user data to the view
        return view('userprofile', compact('userp'));
    } else {
        // Handle case where the user doesn't exist
        return redirect()->route('login')->with('error', 'User not found');
    }
    }
   // Change User profile
   public function updateProfilePicture(Request $request)
   {
       // Validate the uploaded file
       $request->validate([
           'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
       ],
       [
     
        'file.image' => 'The file must be an image.',
        'file.max' => 'The image size must not exceed 2MB.',
    ]);
   
       // Get the user ID from session
       $userId = session('id');  // Assuming session('id') contains the logged-in user's ID
   
       // Find the user by ID from the session
       $user = User::findOrFail($userId); // Using findOrFail to ensure the user exists
   
       // Delete the old profile picture if it exists
       if ($user->picture && file_exists(public_path('uploads/profiles/' . $user->picture))) {
           unlink(public_path('uploads/profiles/' . $user->picture));  // Delete the old image file from the server
       }
   
       // Handle the new file
       $file = $request->file('profile_picture');
       $fileName = time() . '_' . $file->getClientOriginalName(); // Create a unique filename
       $file->move(public_path('uploads/profiles/'), $fileName); // Move the file to the specified folder
   
       // Save only the file name (not the folder path) in the database
       $user->picture = $fileName; // Store only the filename
       $user->save();
   
       return redirect()->back()->with('success', 'Profile picture updated successfully!');
   }

   //Change user name
   public function updateUserName(Request $request)
   {
       // Validate the input
       $request->validate([
           'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
       ],
       [
        'name.required' => 'The name field is required.',
        'name.regex' => 'The name may only contain letters and spaces.',
        'name.max' => 'The name may not be greater than 255 characters.',
       
       ],
       [
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
   
       // Retrieve the logged-in user by ID stored in session
       $userId = session('id'); // Get the user ID from the session
       $user = User::find($userId); // Retrieve the user instance
   
       // Check if the user exists
       if ($user) {
           $user->name = $request->name; // Update the name
           $user->save(); // Save the changes
   
           // Redirect back with a success message
           return redirect()->back()->with('success', 'Name updated successfully!');
       }
   
       // If the user is not found, return an error message
       return redirect()->back()->with('error', 'User not found.');
   }
   
   //change email
   public function updateUserEmail(Request $request)
{
    // Validate the input
    $request->validate([
        'email' => 'required|email|max:255|unique:users,email',
    ],[
       
        'email.required' => 'The email field is required.',
        'email.email' => 'The email must be a valid email address.',
        'email.unique' => 'This email is already registered.',
       
    ]);

    // Retrieve the logged-in user by ID stored in the session
    $userId = session('id'); // Get the user ID from the session
    $user = User::find($userId); // Retrieve the user instance

    // Check if the user exists
    if ($user) {
        $user->email = $request->email; // Update the email
        $user->save(); // Save the changes

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Email updated successfully!');
    }

    // If the user is not found, return an error message
    return redirect()->back()->with('error', 'User not found.');
}
// Change Password
public function updatePassword(Request $request)
{
    // Validate the password fields
    $request->validate([
        'password' => [
            'required',
            'string',
            'min:8',
            'confirmed',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
        ],  // 'confirmed' requires a matching 'password_confirmation' field
    ],
    [
       
        'password.required' => 'The password field is required.',
        'password.min' => 'The password must be at least 8 characters.',
        'password.confirmed' => 'The password confirmation does not match.',
        'password.regex' => 'The password must include at least one uppercase letter, one lowercase letter, one number, and one special character.',
        'password.min' => 'The password must be at least 8 characters.',
        'password.confirmed' => 'The password confirmation does not match.',
    ]);

    // Get the user by the ID stored in the session
    $userId = session()->get('id');
    $user = User::findOrFail($userId);
    
    // Update the user's password
    $user->password = Hash::make($request->password);
    $user->save();

    // Optionally, update the session with the new password (though it's not necessary for most cases)
    // session()->put('password', $user->password);

    return back()->with('success', 'Password updated successfully!');
}


// manage user profile
public function manageProfile(){
    return view('usermanageprofile');
}


// Update User Profile
// In UserController.php
public function updateProfile(Request $request)
{
    // Validate the input data
    $request->validate([
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255', // Only letters and spaces allowed
        'email' => 'required|string|email|max:255|unique:users',  // Valid email, unique
        'password' => [
            'required',
            'string',
            'min:8',
            'confirmed',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
        ],         // Minimum 8 chars, must match confirmation

    ],
    [
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

    // Retrieve the user using the session ID
    $user = User::find(session('id'));

    // Check if user exists
    if (!$user) {
        return redirect()->route('usermanageprofile.show')->with('error', 'User not found.');
    }

    // Update profile picture if provided
    if ($request->hasFile('profile_picture')) {
        // Delete the old profile picture if it exists
        if ($user->picture && file_exists(public_path('uploads/profiles/' . $user->picture))) {
            unlink(public_path('uploads/profiles/' . $user->picture)); // Delete the old file
        }
    
        // Handle the new file
        $file = $request->file('profile_picture');
        $fileName = time() . '_' . $file->getClientOriginalName(); // Create a unique filename
        $file->move(public_path('uploads/profiles/'), $fileName); // Move the file to the 'uploads/profiles/' folder
    
        // Save only the file name in the database
        $user->picture = $fileName;
    }
    

    // Update name and email
    $user->name = $request->input('name');
    $user->email = $request->input('email');

    // Update password if provided
    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }

    // Save the updated profile data
    $user->save();

    // Update session with new data
    session(['name' => $user->name, 'email' => $user->email]);

    return redirect()->route('usermanageprofile.show')->with('success', 'Profile updated successfully.');
}

//Admin registration
 public function registerAdmin(Request $data)
    {
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
            return redirect()->route('signUpAdmin') // Use named route
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
        return redirect()->route('signUpAdmin')->with('wrong', 'Something went wrong. Please try again.');
    }
    
    
     public function adminLogout(Request $request)
    {
        $request->session()->forget('admin_id');
    
    
        // Redirect to the login page
        return redirect()->route('login');
    }
    



}