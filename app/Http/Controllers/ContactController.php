<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;
class ContactController extends Controller
{
    public function submit(Request $request)
    {
        if(session()->get('id')){
// Validate the form data
$validated = $request->validate([
    'name' => 'required|string|max:255',
    'email' => 'required|email|max:255',
    'address' => 'required|string|max:255',
    'message' => 'required|string',
]);

// Store the data in the database
Contact::create([
    'user_id' => session('id'), // Get the logged-in user ID from the session
    'name' => $request->name,
    'email' => $request->email,
    'address' => $request->address,
    'message' => $request->message,
]);

// Redirect with a success message
return redirect()->route('usercontacthistory')->with('success', 'Your Message submitted successfully!');
        }
        else{
            return redirect()->route('login');
           }
    }


   //show the conatct data
    public function showContacts()
{
// Fetch a user by ID
$user = User::find(session()->get('id')); // Replace 1 with the actual user ID
// Get all contacts associated with the user
$contacts = $user->contacts;   
    return view('usercontacthistory', compact('contacts'));
}

   //show the conatct data in admin panel
    public function showUserContacts()
{
// Fetch a user by ID
$contacts = Contact::all(); 
 
    return view('admin.usercontacthistory', compact('contacts'));
}
}
