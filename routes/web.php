<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MeasurementController;
use App\Models\Measurement;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});
Route::get('/najeebm', function () {
    return view('najeebmeasurement');
});

Route::get('/home', function () {
    return view('Home');
})->name('home');

Route:: get('/about',function(){
    return view('about');
})->name('about');

Route:: get('/contactus',function(){
    return view('contactUs');
});

Route:: get('/signUp',function(){
    return view('signUp');
})->name('signUp');

Route:: get('/welcome',function(){
    return view('welcome');
});

Route:: get('/signIn',function(){
    return view('signIn');
})->name('login');

Route:: get('/headerFooter',function(){
    return view('headerFooter');
});

Route:: get('/product',function(){
    return view('product');
});
Route::get('/productDetails', [UserController::class, 'displayProductDetails']);


//Ready made
Route:: get('/readymade_Details',function(){
    return view('readymade_Details');
});

Route:: get('/measurement',function(){
    return view('measurement');
})->name('measurement');

Route:: get('/footer',function(){
    return view('pages.footer');
});
Route:: get('/header',function(){
    return view('pages.header');
});

Route:: post('/registerUser',[UserController::class,'registerUser']);
Route:: post('/loginUser',[UserController::class,'loginUser']);
Route:: get('/logout',[UserController::class,'logout']);


Route::get('/profile', [UserController::class, 'profile'])->name('profile');

Route::get('/masterLayout', function(){
    return view('masterLayout');
});

//User Profile
Route::get('/userprofile', [UserController::class, 'myprofile']);
//update user profile
Route::post('/update-profile-picture', [UserController::class, 'updateProfilePicture'])->name('update.profile.picture');


Route:: post('/uploadnewproduct',[AdminController::class,'addproduct']);
Route::get('/product', [UserController::class, 'displayProduct'])->name('product');
Route::get('/ready_made', [UserController::class, 'displayReadyMade'])->name('ready.made');
// store contact data 
Route::post('/contact.store', [ContactController::class, 'submit'])->name('contact.store');
Route::get('/usercontact',[AdminController::class, 'showContacts']);
// Contact submissions page

Route::get('/user-contact-history', [ContactController::class, 'showContacts'])->name('usercontacthistory');
  
// Submit measurement form
Route::post('/measurementstore', [MeasurementController::class, 'store'])->name('measurement.store');
// Fetch the measurement data
Route::get('/measurementDetails', [MeasurementController::class, 'measurementDetails'])->name('measurementDetails');
// Fetch login user measurement
Route::get('/measurements_index', [MeasurementController::class, 'index'])->name('measurements.index');
//showMeasurement
Route::get('/showmeasurement', [MeasurementController::class, 'showMeasurement'])->name('measurements.show');
//updateMeasurement
Route::post('/updatemeasurement', [MeasurementController::class, 'updateMeasurement'])->name('measurements.update');


Route::post('/place-order', [OrderController::class, 'store'])->name('place-order');
Route::get('/abproduct', [UserController::class, 'displayProduct'])->name('product');
Route::get('/displayOrder', [OrderController::class, 'showLoginUserOrders'])->name('displayOrder');
// Route::get('/displayOrder', [OrderController::class, 'showUserOrders'])->name('displayOrder');
//user pending
Route::get('/displayPendingOrder', [OrderController::class, 'showUserPendingOrders'])->name('displayPendingOrder');
//Change user name
Route::post('/update-user-name', [UserController::class, 'updateUserName'])->name('updateUserName');
//change user  email
Route::post('/update-user-email', [UserController::class, 'updateUserEmail'])->name('updateUserEmail');

// GET route for displaying the user profile
Route::get('/manageuserprofile', [UserController::class, 'manageProfile'])->name('usermanageprofile.show');

// POST route for updating the user profile
Route::post('/manageuserprofile', [UserController::class, 'updateProfile'])->name('usermanageprofile.update');
//Change user password
Route::post('/user/update-password', [UserController::class, 'updatePassword'])->name('user.updatePassword');
//Inoice

// Define route for viewing the invoice
Route::get('/invoice', [OrderController::class, 'showInvoice'])->name('invoice.show');
//Download order
Route::get('/content/{orderId}', [OrderController::class, 'downloadInvoice'])->name('invoice.download');
//View 
Route::get('/userordersview/{orderId}', [OrderController::class, 'viewOrder'])->name('user.order.view');

Route::get('/orders/{orderId}', [OrderController::class, 'destroy'])->name('orders.destroy');

Route::get('/invoice/view/all', [OrderController::class, 'showallInvoice'])->name('showall.orders');




// Admin site routes
// Route::get('/najeebmaster', function () {
//     return view('admin.adminlayouts.adminLayout');
// });

Route::get('/najeebmaster', [AdminController::class, 'adminSmallProfile']);

//order
Route::get('/orders', function () {
    return view('admin.orders');
});

Route::get('/test', function () {
    return view('test');
});
//Checkout
Route::get('/checkout', function () {
    return view('checkout');
});

//admin site
//upload product
Route:: get('/uploadProduct', function(){
    return view('admin/uploadProduct');          
});
//Display product
Route::get('/productlist', [AdminController::class, 'ProductList']);
//Admin product Detail
Route::get('/admin_productDetails', [AdminController::class, 'AdminproductDetails'])->name('admin.productDetails');
//Dashboard

Route::get('/displayDashboard', [DashboardController::class, 'showDashboard'])->name('displayDashboard');



Route::get('/customers', [AdminController::class, 'customersDetails']);


//Order Details

Route::get('/ordersdetails', [AdminController::class, 'showOrders']);

//Pending Orders
Route::get('/pendingorders', [AdminController::class, 'pendingOrders']);
//Cancelled Orders
Route::get('/cancelleddorders', [AdminController::class, 'cancelledOrders']);

//Completed Orders
Route::get('/completedorders', [AdminController::class, 'paidOrders']);
// View order
Route::get('/orders/view/{orderId}', [AdminController::class, 'viewOrder'])->name('orders.view');
//Measurements
Route::get('/measurements', [MeasurementController::class, 'measurements']);

//Admin Profile
Route::get('/adminprofile',[AdminController::class, 'adminProfile']);


//Update status
Route::post('/admin/orders/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.orders.updateStatus');
// Update admin name
Route::post('/admin/update-name', [AdminController::class, 'updateName'])->name('admin.updateName');
// Update email
Route::post('/admin/update-email', [AdminController::class, 'updateEmail'])->name('admin.updateEmail');
//Change admin picture
Route::post('/admin/update-photo', [AdminController::class, 'updatePicture'])->name('admin.updatePicture');
//Admin password change
Route::post('/admin/change-password', [AdminController::class, 'changePassword'])->name('admin.changePassword');
// Setting admin manage profile
Route::get('/s_a_manageprofile', [AdminController::class, 'settingupdateProfile'])->name('s_a_manageprofile');

// Profile page
Route::get('/admin_manageprofile', [AdminController::class, 'updateProfile'])->name('admin.manage.profile');
// Admin register
Route::get('admin_register', function(){

    return view('admin.admin_register');
})->name('admin.register');
Route::post('/registeradmin', [AdminController::class, 'AdminRegister'])->name('admin.register');
//Chart
Route::get('/charts', [OrderController::class, 'showCharts'])->name('charts');
Route::get('/profits', [AdminController::class, 'showProfits'])->name('profits');
//view user pendding
Route::get('/viewuserpendding/{orderId}', [OrderController::class, 'ViewUserPendding'])->name('view.user.pendding');
//Register Admin
Route:: post('/registerAdmin',[UserController::class,'registerAdmin'])->name('register.Admin');
Route:: get('/signUpAdmin',function(){
    return view('admin/admin_register');
})->name('signUpAdmin');
//Eech user Measurement
Route::get('/eachuser/{orderId}',[MeasurementController::class,'EachUserMeasurement'])->name('each.user');
//user Contact History
Route::get('/adminusercontact',[ContactController::class,'showUserContacts']);
//Admin logout
Route:: get('/adminlogout',[UserController::class,'adminLogout']);


