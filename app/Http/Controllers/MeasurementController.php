<?php
namespace App\Http\Controllers;
use App\Models\Measurement;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class MeasurementController extends Controller
{
    public function store(Request $request)
    {
       if(session()->get('id')){
          // Validate the incoming data
          $request->validate(
            [
                'user_id' => 'required|exists:users,id',
                'full_name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255', // Only letters and spaces allowed
                'email' => 'required|string|email|max:255|unique:measurements', // Valid email, unique
                'phone_no' => 'required|string|regex:/^\d{10,15}$/', // Phone number: 10 to 15 digits
                'address' => 'required|string|max:500',
                
             
                'length' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
                'width' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
                'chest' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
                'shoulder' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
                'sleeve_length' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
                'neck' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
                'cuff' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
                'shalwar_length' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
                'hem' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
                
                // Optional fields
                'neck_type' => 'nullable|string|max:255',
                'neck_type_length' => 'nullable|string|max:255',
                'sleeve_type' => 'nullable|string|max:255',
                'sleeve_type_length' => 'nullable|string|max:255',
                'pocket' => 'nullable|array', // Ensure this is an array for multiple values
                'pocket_quantity' => 'nullable|numeric|min:1|max:10', // Pocket quantity: numeric, 1-10
            ],
            [
                // Custom error messages
                'name.required' => 'The  name field is required.',
                'name.regex' => 'The  name may only contain letters and spaces.',
                'name.max' => 'The  name may not be greater than 255 characters.',
                'email.required' => 'The email field is required.',
                'email.email' => 'The email must be a valid email address.',
                'phone_no.required' => 'The phone number is required.',
                'phone_no.regex' => 'The phone number must be between 10 and 15 digits.',
                'length.regex' => 'The length must be a number in the format 40.00.',
                'width.regex' => 'The width must be a number in the format 40.00.',
                'chest.regex' => 'The chest must be a number in the format 40.00.',
                'shoulder.regex' => 'The shoulder must be a number in the format 40.00.',
                'sleeve_length.regex' => 'The arm length must be a number in the format 40.00.',
                'neck.regex' => 'The neck must be a number in the format 40.00.',
                'cuff.regex' => 'The cuff must be a number in the format 40.00.',
                'shalwar_length.regex' => 'The shalwar length must be a number in the format 40.00.',
                'hem.regex' => 'The hem must be a number in the format 40.00.',
            ]
        );
        

        // Create a new measurement record
        $measurement = new Measurement();
        $measurement->user_id = $request->user_id;
        $measurement->name = $request->full_name; // Make sure it matches the input name
        $measurement->email = $request->email;
        $measurement->phoneNo = $request->phone_no;
        $measurement->address = $request->address;
        $measurement->length = $request->length;
        $measurement->width = $request->width;
        $measurement->chest = $request->chest;
        $measurement->sleeve_length = $request->sleeve_length; // Correct variable
        $measurement->shoulder = $request->shoulder;
        $measurement->neck = $request->neck;
        $measurement->cuff = $request->cuff;
        $measurement->shalwarLength = $request->shalwar_length; // Correct variable
        $measurement->hem = $request->hem;

        // Store the new form fields
        $measurement->neck_type = $request->input('neck_type');
        $measurement->neck_type_length = $request->neck_type_length;
        $measurement->sleeve_type = $request->input('sleeve_type');
        $measurement->sleeve_type_length = $request->sleeve_type_length;
        $measurement->pocket = $request->has('pocket') ? json_encode($request->input('pocket')) : null; // Store as a JSON array
        $measurement->pocket_quantity = $request->pocket_quantity;
        // Save the data
        $measurement->save();
           // Store the measurement IDs in the session
    $measurementIds = $measurement->pluck('id')->toArray();
    if (!$measurementIds) {
        session()->forget('measurement_ids');
    }
    
        session()->put('measurement_ids', $measurementIds);
    
   
        // Redirect to the form or a success page
        return redirect()->route('measurement')->with('success', 'Measurement saved successfully!');
       }
       else{
        return redirect()->route('login');
       }
    }


public function index()
{
    // Fetch the logged-in user's measurements
    $measurements = Measurement::where('user_id', session()->get('id'))->get();
  
    // Pass data to the view
    return view('fetchmeasurement', compact('measurements')); // Pass data to the view
}

public function measurementDetails()
{
    // Fetch the logged-in user's measurements
    $measurementsDetails = Measurement::all();
  
    // Pass data to the view
    return view('admin.measurementsDetails', compact('measurementsDetails')); // Pass data to the view
}

//Fecth measurement

public function showMeasurement()
{
    // Fetch the logged-in user's measurements
    $showmeasurements = Measurement::where('user_id', session()->get('id'))->get();
  
    // Check if no measurements are found
    if ($showmeasurements->isEmpty()) {
        $errorMessage = "No measurements found for your account.";
        return view('managemeasurement', compact('showmeasurements', 'errorMessage'));
    }
else{
  // Pass data to the view if measurements exist
  return view('managemeasurement', compact('showmeasurements'));
}
  
}


//Udpadet Mesurement
public function updateMeasurement(Request $request)
{
    // Get the current user ID from session
    $measurement_id = session()->get('measurement_ids');
    if($measurement_id){
 // Find the existing record in the 'measurements' table by user_id
 $measurement = Measurement::where('id', $measurement_id )->first();
    }
    else{
        return redirect()->back()->with('wrong', 'No measurement found for this user.');
    }
   

    // Check if a record exists for the given user
    if ($measurement) {
        // Update the fields with the values from the form request
       
        $measurement->user_id = $request->userid;
        $measurement->name = $request->name; // Make sure it matches the input name
        $measurement->email = $request->email;
        $measurement->phoneNo = $request->phone;
        $measurement->address = $request->address;
        $measurement->length = $request->length;
        $measurement->width = $request->width;
        $measurement->chest = $request->chest;
        $measurement->sleeve_length = $request->sleeve_length; // Correct variable
        $measurement->shoulder = $request->shoulder;
        $measurement->neck = $request->neck;
        $measurement->cuff = $request->cuff;
        $measurement->shalwarLength = $request->shalwarlength; // Correct variable
        $measurement->hem = $request->hem;

        // Store the new form fields
        $measurement->neck_type = $request->input('neck_type');
        $measurement->neck_type_length = $request->neck_type_length;
        $measurement->sleeve_type = $request->input('arm_type');
        $measurement->sleeve_type_length = $request->arm_type_length;
        $measurement->pocket = $request->has('pocket') ? json_encode($request->input('pocket')) : null; // Store as a JSON array
        $measurement->pocket_quantity = $request->pocket_quantity;
        // Save the data
        $measurement->save();
        // Return success message
        return redirect()->back()->with('success', 'Measurement updated successfully!');
    } else {
        // Handle case if no record is found
        return redirect()->back()->with('error', 'No measurement found for this user.');
    }
}


public function EachUserMeasurement($orderId)
{
    // Step 1: Get the order using the provided order ID
    $order = Order::find($orderId);

    // Optional: Handle case when order is not found
    if (!$order) {
        abort(404, 'Order not found');
    }

    // Step 2: Get the user_id from the order
    $userId = $order->user_id;

    // Step 3: Fetch measurements for that user
    $eachUserMeasurement = Measurement::where('user_id', $userId)->get();

    return view('admin.eachusermeasurement', compact('eachUserMeasurement'));
}

}
