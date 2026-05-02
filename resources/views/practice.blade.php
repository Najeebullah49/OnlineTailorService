<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','Online Tailor Service')</title>
    <style>
      /* List Cart Scrollbar */
.listCart {
    height: 200px;
    max-height: 60vh;
    overflow-y: auto;
    scrollbar-width: thin; /* For Firefox */
    scrollbar-color: #007bff #f1f1f1;
  
}
.listCart::-webkit-scrollbar {
    width: 8px;
}
.listCart::-webkit-scrollbar-thumb {
    background-color: #007bff;
    border-radius: 10px;
}
.listCart::-webkit-scrollbar-track {
    background: #f1f1f1;
}

/* Cart Item Image */
.cart-item img {
    width: 40px;
    height: 40px;
}
@media (min-width: 768px) {
    .cart-item img {
        width: 50px;
        height: 50px;
        
    }
}

/* Quantity Box */
.quantity {
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Increase/Decrease Buttons */
.decrease-btn,
.increase-btn {
    width: 20px;
    height: 20px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background-color: #333;
    color: #fff;
}

/* Close Button */
.btn-close {
    background: transparent;
    border: none;
}

/* Optional Push-Down for Dropdowns */
.push-down {
    margin-top: 10px;
}



    </style>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- In the <head> section -->
<link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet">
{{-- <link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"
          integrity=
"sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg=="
          crossorigin="anonymous" 
          referrerpolicy="no-referrer" /> --}}

          <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="showCar">
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand text-light" href="/home">NAJEEB TAILOR</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
        aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 200px;">
          <li class="nav-item">
            <a class="nav-link active text-light" aria-current="page" href="/home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="/about">About</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarScrollingDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              Shop
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
              <li><a class="dropdown-item" href="/product">Custom Shop</a></li>
              <li><a class="dropdown-item" href="{{route('ready.made')}}">Readymade Shop</a></li>
            
            </ul>
          </li>
         
          <li class="nav-item">
          <a class="nav-link  text-light" href="/contactus" tabindex="-1" aria-disabled="true">Contact</a>
          </li>
          <li class="nav-item">
          <a class="nav-link text-light" href="/measurement" tabindex="-1" aria-disabled="true">Measurement</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link  text-light" href="{{route('displayPendingOrder')}}" tabindex="-1" aria-disabled="true">Orders</a>
          </li>
      </div>
      </a>
      </li>

        

      <ul class="navbar-nav  my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 400px;">
        <li class="nav-item dropdown">
          <a class="nav-link text-primary dropdown-toggle " href="#" id="shopingCart" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
         Cart Count Display

<!-- Cart Count Display (Initially hidden by default) -->

<span id="cart-count" class="rounded-circle  bg-danger text-center ms-3 text-white" style="font-size: 13px; width: 20px; height: 20px; position: fixed; display: none; cursor: pointer;"></span>

<svg
              class="w-6 h-6 text-gray-800 dark:text-white text-white " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
              width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
            </svg>
            
          </a>
       


<ul class="dropdown-menu dropdown-menu-end"  id="shoppingCartDropdown" aria-labelledby="shoppingCart" data-bs-auto-close="manual">
    <li class="dropdown-item p-2" style="width: 100%; max-width: 450px;height:400px;  max-height: 100%;">
      
            <!-- Close Button -->
            <button class="btn-close float-end mb-5" id="closeCart" aria-label="Close"></button>
  <!-- Container for cart content -->
        <div class="container-fluid  px-2 mt-4 mx-auto" style="min-width: 320px; height:377px;">
            <!-- Heading -->
            <h3 class="text-center my-2 mx-auto">Shopping Cart</h3>

            <!-- Scrollable Area -->
            <div class="row text-center bg-light listCart"
                 style="max-height: 200px; overflow-y: auto; scrollbar-width: thin;"
                 id="cartItemsContainer">
                <!-- Cart items will be dynamically injected here -->
            </div>

            <!-- Checkout & Total -->
            <div class="row mt-3">
                <div class="col-11 bg-dark rounded shadow p-3">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                        <!-- Checkout Button -->
                        <a href="{{ asset('/checkout') }}" class="btn btn-success w-100 w-md-auto text-white fw-bold">
                            Check Out
                        </a>

                        <!-- Total Price -->
                        <div class="btn btn-light text-dark fw-bold w-100 w-md-auto border">
                            Total: <span id="totalPrice">0.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
</ul>




          <!-- buttom -->
        </li>
      </ul>

      @if(isset($user))

<ul class="navbar-nav  my-2 mx-auto my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 500px;">
    <li class="nav-item dropdown">
        {{-- Profile Icon in Navbar --}}
        <a class="nav-link dropdown-toggle text-primary text-center d-flex align-items-center" 
           href="{{ route('profile') }}" 
           id="navbarScrollingDropdown" 
           role="button" 
           data-bs-toggle="dropdown" 
           aria-expanded="false">

            {{-- Show uploaded picture or default --}}
            <img src="{{ !empty($user->picture) && file_exists(public_path('uploads/profiles/'.$user->picture)) 
                        ? asset('uploads/profiles/'.$user->picture) 
                        : asset('images/profile/defaultprofile.png') }}" 
                 class="rounded-circle border border-secondary" 
                 style="width: 35px; height: 35px; object-fit: cover;" 
                 alt="Profile" 
                 loading="lazy">
        </a>

        {{-- Dropdown Menu --}}
        <ul class="dropdown-menu dropdown-menu-end p-2 shadow" aria-labelledby="navbarScrollingDropdown" style="min-width: 320px;">
            <li class="text-center mb-2">
                {{-- Profile Image in Dropdown --}}
                <img src="{{ !empty($user->picture) && file_exists(public_path('uploads/profiles/'.$user->picture)) 
                            ? asset('uploads/profiles/'.$user->picture) 
                            : asset('images/profile/defaultprofile.png') }}" 
                     class="rounded-circle border border-secondary" 
                     style="width: 70px; height: 70px; object-fit: cover;" 
                     alt="Profile" 
                     loading="lazy">
                <div class="fw-bold mt-2">{{ $user->name }}</div>
                <small class="text-muted">{{ $user->email }}</small>
            </li>

            <li><hr class="dropdown-divider"></li>

            {{-- Menu Items --}}
            <li><a class="dropdown-item" href="/userprofile"><i class="bi bi-person-circle me-2"></i> My Profile</a></li>
            <li><a class="dropdown-item" href="{{ route('displayOrder') }}"><i class="bi bi-bag-check me-2"></i> Order History</a></li>
            <li><a class="dropdown-item" href="{{ route('measurements.index') }}"><i class="bi bi-rulers me-2"></i> Measurement History</a></li>
            <li><a class="dropdown-item" href="{{ route('usercontacthistory') }}"><i class="bi bi-chat-dots me-2"></i> Contact History</a></li>
            <li><a class="dropdown-item" href="{{ route('showall.orders') }}"><i class="bi bi-receipt me-2"></i> Invoice History</a></li>

            {{-- Settings Submenu --}}
            <li class="dropdown-submenu dropstart">
                <a class="dropdown-item dropdown-toggle" href="#" id="settingsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-gear me-2"></i> Settings
                </a>
                <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
                    <li><a class="dropdown-item" href="{{ route('usermanageprofile.show') }}">Manage Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('measurements.show') }}">Manage Measurement</a></li>
                </ul>
            </li>

            {{-- Logout --}}
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item text-danger" href="{{ URL::to('logout') }}"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
        </ul>
    </li>
</ul>





@else
<ul class="navbar-nav mx-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 300px;">
    <li class="nav-item dropdown ">
  
      <a class="nav-link dropdown-toggle text-primary " href="{{ route('profile') }}" id="navbarScrollingDropdown" role="button"
        data-bs-toggle="dropdown" aria-expanded="false">
       <img src="{{ asset('images/profile/defaultprofile.png') }}" class="rounded-circle" height="25"
         alt="Black and White Portrait of a Man" loading="lazy" />
    
      </a>
    


      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarScrollingDropdown" style="min-width: 320px;">
        <li>
          <a class="dropdown-item d-flex" href="">
          Please Login or Register <small class="mx-2">
              </small>
          </a>
        <li>
          <hr class="dropdown-divider">
        </li>
    </li>

    <li>
      <a class="dropdown-item" href="{{route('login')}}">Login</a>
    </li>
    <li>
      <a class="dropdown-item" href="{{route('signUp')}}">Register</a>
    </li>

  </ul>
      </li>
      </ul>
@endif
   


    </div>
  </nav>

@yield('content')

  <!-- Footer -->
  <footer class="text-center text-lg-start bg-dark text-light text-muted bg-dark">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">


      <!-- Right -->
      <div class="text-white text-">
        <a href="https://web.facebook.com/profile.php?id=100030995204920" class="me-4 text-reset">
          <i class="fab fa-facebook-f"></i>Facebook
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-twitter"></i>Twitter
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-google"></i>Google
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-instagram"></i>Instegram
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-linkedin"></i>Linkedin
        </a>

      </div>
      <!-- Right -->
    </section>
    <section class="bg-dark">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4 text-light">
              <i class="fas fa-gem me-3 text-light"></i>Company name
            </h6>
            <p class="text-light">
              Online Tailor Service: This company provide cloths door to door 
            </p>
          </div>
          <!-- Grid column -->
  
          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4 text-light">
              Products
            </h6>
            <p class="text-light">
              <a href="/product" class="text-reset text-light">Custom Shop</a>
            </p>
            <p class="text-light">
              <a href="{{route('ready.made')}}" class="text-reset text-light">Ready Made Shop</a>
            </p>
          
          </div>
          <!-- Grid column -->
  
          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4 text-light">
             Links
            </h6>
            <p class="text-light">
              <a href="/home" class="text-reset text-light">Home</a>
            </p>
            <p class="text-light">
              <a href="/aboutus" class="text-reset text-light">About</a>
            </p>
            <p class="text-light">
              <a href="/product" class="text-reset text-light">Shop</a>
            </p>
            <p class="text-light">
              <a href="/contactus" class="text-reset text-light">Contact</a>
            </p>
          </div>
          <!-- Grid column -->
  
          <!-- Grid column -->  
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4 text-light">Contact</h6>
            <p class="text-light"><i class="fas fa-home me-3"></i>University road Karachi askary Park</p>
            <p class="text-light">
              <i class="fas fa-envelope me-3 text-light"></i>
              nu085051@gmail.com
            </p>
            <p class="text-light"><i class="fas fa-phone me-3"></i> +92 3000033681</p>
            <p class="text-light"><i class="fas fa-print me-3"></i> +92 3021020253</p>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4 text-light bg-dark" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2024 Copyright
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
   
   <!-- Before the closing </body> tag -->
   <script src="{{asset('js/bootstrap.bundle.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}
@stack('script')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownMenu = document.getElementById('shoppingCartDropdown');
        const closeCartButton = document.getElementById('closeCart');

        // Prevent dropdown from closing when clicking outside
        document.addEventListener('click', function (event) {
            const isClickInside = dropdownMenu.contains(event.target);
            const isCartButton = event.target.closest('[aria-labelledby="shoppingCart"]');

            // If clicking outside and not on the dropdown toggle button, do nothing
            if (!isClickInside && !isCartButton) {
                event.stopPropagation();
            }
        });

        // Close the dropdown when the "x" button is clicked
        closeCartButton.addEventListener('click', function () {
            dropdownMenu.classList.remove('show'); // Hides the dropdown
        });

        // Keep dropdown open on dropdown content click
        dropdownMenu.addEventListener('click', function (event) {
            event.stopPropagation(); // Prevent hiding on internal clicks
        });
    });
</script>


<script>
  // Function to load and display cart items
document.addEventListener('DOMContentLoaded', function () {
    updateCartDisplay(); // Load and display the cart items when the page is loaded
});

// Update the quantity of cart item
function updateCartItem(index, change) {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const item = cart[index];
    
    // Update quantity, ensure it doesn't go below 1
    item.quantity = Math.max(0, item.quantity + change);

    if (item.quantity === 0) {
        // If the quantity is 0, remove the product from the cart
        cart.splice(index, 1); // Remove the item from the cart
    }

    localStorage.setItem('cart', JSON.stringify(cart)); // Save updated cart to localStorage
    updateCartDisplay(); // Update the cart display dynamically
}

// Remove item from cart
function removeCartItem(index) {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.splice(index, 1); // Remove item at the specified index
    localStorage.setItem('cart', JSON.stringify(cart)); // Save updated cart to localStorage
    updateCartDisplay(); // Update the cart display dynamically
}

// Update the cart display without reloading the page
function updateCartDisplay() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartItemsContainer = document.getElementById('cartItemsContainer');
    cartItemsContainer.innerHTML = '';  // Clear previous cart display
    let totalPrice = 0;

    if (cart.length === 0) {
        cartItemsContainer.innerHTML = '<p>Your cart is empty.</p>';
        document.getElementById('totalPrice').textContent = 'PKR 0.00'; // Total price is zero when the cart is empty
        return;
    }

    cart.forEach((item, index) => {
        // Calculate subtotal (price * quantity) for this item
        const itemTotalPrice = item.price * item.quantity; 
        totalPrice += itemTotalPrice;

        // Create cart item HTML dynamically
const cartItemHTML = `
  <div class="col-12 mt-2 cart-item" data-price="${item.price}">
    <div class="d-flex align-items-center justify-content-between flex-wrap" style="gap: 0.5rem;">
      
      <!-- Product Image -->
      <div style="flex: 0 0 50px; max-width: 50px;">
        <img src="${item.image}" alt="${item.name}" class="img-fluid rounded">
      </div>

      <!-- Product Name -->
      <div style="flex: 1 1 120px;" class="text-truncate">
        ${item.name}
      </div>

      <!-- Price -->
      <div style="flex: 0 0 90px;" class="text-nowrap">
        PKR ${itemTotalPrice.toFixed(2)}
      </div>

      <!-- Quantity Controls -->
      <div class="d-flex align-items-center" style="flex: 0 0 auto;">
        <span class="decrease-btn px-2" onclick="updateCartItem(${index}, -1)"> &lt; </span>
        <span class="quantity px-2">${item.quantity}</span>
        <span class="increase-btn px-2" onclick="updateCartItem(${index}, 1)"> &gt; </span>
      </div>

      <!-- Remove Button -->
      <div style="flex: 0 0 auto;">
        <button class="btn btn-danger btn-sm" onclick="removeCartItem(${index})">x</button>
      </div>
      
    </div>
  </div>
`;



        cartItemsContainer.innerHTML += cartItemHTML;
    });

    // Update total price dynamically
    document.getElementById('totalPrice').textContent = `${totalPrice.toFixed(2)}`;
}

</script>
 <!-- Cart icon -->
  <script>
// Function to update the cart count from localStorage
function updateCartCount() {
    const cartItems = JSON.parse(localStorage.getItem('cart')) || [];
    const cartCount = cartItems.length;
    const cartCountElement = document.getElementById('cart-count');
    
    // Show the cart count if items exist, otherwise hide it
    if (cartCount > 0) {
        cartCountElement.textContent = cartCount;
        cartCountElement.style.display = 'inline-block';  // Show the cart count
    } else {
        cartCountElement.style.display = 'none';  // Hide the cart count if no items
    }
}

// Event listener to hide the cart count span when clicked
document.getElementById('cart-count').addEventListener('click', () => {
    const cartCountElement = document.getElementById('cart-count');
    cartCountElement.style.display = 'none';  // Hide the cart count span on click
});

// Initialize the cart count (it will only update if there are items in the cart)
updateCartCount();

  </script>

<script>
  // Ensure the main dropdown stays open when clicking on "Settings"
document.querySelectorAll('.dropdown-submenu').forEach(function(submenu) {
  submenu.addEventListener('click', function(event) {
    event.stopPropagation(); // Prevent closing of main dropdown
  });
});

</script>
//show count by j query
<script>
$(document).ready(function () {

    // Always hide the cart count on page load
    $('#cart-count').hide();

    // Show cart count ONLY when Add To Cart is clicked
    $('.btn-primary').on('click', function () {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        if (cart.length > 0) {
            $('#cart-count').text(cart.length).show();
            sessionStorage.setItem('cartVisible', 'yes'); // flag set for session
        }
    });

    // Hide cart count when it's clicked
    $('#cart-count').on('click', function () {
        $(this).hide();
        sessionStorage.removeItem('cartVisible');
    });
});
</script>


</body>
</html>