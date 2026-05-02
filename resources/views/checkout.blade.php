@extends('layouts.masterLayout')
@section('content')
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@section('title')
       Product Detail
        @endsection</title>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .card {
      border: none;
    }

    .form-control {
      border-radius: 0.375rem;
    }

    .order-summary {
      background: #ffffff;
      border-radius: 0.375rem;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .order-items {
      flex-grow: 1;
      overflow-y: auto;
      max-height: 350px;
    }
  </style>
</head>

<body>
<form action="{{route('place-order')}}" method="POST">
@csrf 
<!-- product size -->
<input type="hidden" name="sizecart" id="sizecartInput">

<input type="hidden" name="status" value="pending">

  <div class="container my-5">
  <!-- message show start -->
  <div class="d-flex justify-content-center mt-4">
    <div class="w-50">
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif
    </div>
</div>
<!-- message show end -->
    <div class="row g-4">
      <!-- Billing Information -->
      <div class="col-lg-7">
        <h3 class="mb-4">Billing Details</h3>
        <div class="card p-4">
       
            <!-- Name -->
            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
            </div>
            <!-- Phone -->
              <div class="mb-3">
              <label for="phone" class="form-label">Phone</label>
              <input type="number" name="phone" class="form-control" id="phone" placeholder="Enter your phone" required>
            </div>
            <!-- Address -->
            <div class="mb-3">
              <label for="address" class="form-label">Address</label>
              <input type="text" name="address" class="form-control" id="address" placeholder="Enter your address" required>
            </div>

            <!-- City -->
            <div class="mb-3">
              <label for="city" class="form-label">City</label>
              <input type="text" name="city" class="form-control" id="city" placeholder="Enter your city" required>
            </div>

            <!-- Country -->
            <div class="mb-3">
              <label for="country" class="form-label">Country</label>
              <select class="form-select" name="country" id="country" required>
                <option selected disabled>Choose your country</option>
                <option value="pakistan">Pakistan</option>
                <option value="uk">Saudi Arabia</option>
                <option value="canada">Qater</option>
                <option value="australia">United Arab Imarat</option>
              </select>
            </div>

            <!-- Payment Method -->
            <div class="mb-3">
    <label class="form-label">Payment Method</label>
    </div>
     <!-- Bank Transfer Option -->
<div class="form-check">
    <input class="form-check-input" type="radio" name="payment" id="bankTransfer" value="bank" onclick="showPaymentDetails('bank')" checked>
        <label class="form-check-label" for="bankTransfer">
            JazzCash
        </label>
</div>
    <!-- EasyPaisa Option -->
    <div class="form-check">
        <input class="form-check-input" type="radio" name="payment" id="easyPaisa" value="easyPaisa" onclick="showPaymentDetails('easyPaisa')">
        <label class="form-check-label" for="easyPaisa">
            EasyPaisa
        </label>
    </div>

    <!-- Cash on Delivery Option -->
    <div class="form-check">
        <input class="form-check-input" type="radio" name="payment" id="cod" value="cod" onclick="showPaymentDetails('cod')">
        <label class="form-check-label" for="cod">
            Cash on Delivery
        </label>
    </div>
</div>

<!-- Payment Details Section (hidden by default) -->
<div id="paymentDetails" class="mt-3">
    <!-- Bank Transfer Details -->
    <div id="bankDetails" class="payment-method-details" style="display: block;">
        <h5>JazzCash Details:</h5>
        <p><strong>Account Holder:</strong> Najeeb Ullah</p>
        <p><strong>Account Number:</strong> 03021020253</p>
    </div>

    <!-- EasyPaisa Details -->
    <div id="easyPaisaDetails" class="payment-method-details" style="display: none;">
        <h5>EasyPaisa Details:</h5>
        <p><strong>Account Holder:</strong> Najeeb Ullah</p>
        <p><strong>Account Number:</strong> 03483703554</p>
    </div>
    
    <!-- Cash on Delivery Details -->
    <div id="codDetails" class="payment-method-details" style="display: none;">
        <h5>Cash on Delivery:</h5>
        <p>Pay when your order is delivered to your doorstep.</p>
    </div>
</div>

<!-- end -->
       
        </div>
        <!-- Order Summary -->
 <div class="col-lg-5">
  <h3 class="mb-4">Order Summary</h3>
  <div class="order-summary">
    <!-- Empty cart message -->
    <div id="empty-cart-message" style="display: none;">
      <p class="text-center">Your cart is empty.</p>
    </div>

    <div id="order-summary" class="order-items order-summary"></div>
    <hr>

    <!-- Total -->
    <div class="d-flex justify-content-between mb-3">
      <h5>Total</h5>
      <h5 id="total-price">$0.00</h5>
    </div>
    <input type="hidden" class="form-control" id="order" name="order" value="">

    <button id="place-order-btn" type="submit" class="btn btn-primary w-100 mt-3">Place Order</button>
  </div>
</div>
      </div>
 

    </div>
  </div>
  </form>
<!-- Add this script to dynamically show payment details based on the selected method -->
<script>
    function showPaymentDetails(paymentMethod) {
        // Hide all payment method details initially
        document.getElementById('bankDetails').style.display = 'none';
        document.getElementById('easyPaisaDetails').style.display = 'none';
        document.getElementById('codDetails').style.display = 'none';

        // Show the selected payment method details
        if (paymentMethod === 'bank') {
            document.getElementById('bankDetails').style.display = 'block';
        } else if (paymentMethod === 'easyPaisa') {
            document.getElementById('easyPaisaDetails').style.display = 'block';
        } else if (paymentMethod === 'cod') {
            document.getElementById('codDetails').style.display = 'block';
        }
    }
</script>
  
<script>
 document.addEventListener("DOMContentLoaded", function() {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];  // Get cart data from localStorage
    const orderSummary = document.getElementById("order-summary");
    const totalPriceElement = document.getElementById("total-price");
    const emptyCartMessage = document.getElementById("empty-cart-message");
  
    // Function to render each product in the cart
    function renderCart() {
        let total = 0;
        orderSummary.innerHTML = '';  // Clear previous content

        if (cart.length === 0) {
            emptyCartMessage.style.display = 'block';  // Show empty cart message
        } else {
            emptyCartMessage.style.display = 'none';  // Hide empty cart message

            cart.forEach((product, index) => {
                const productElement = document.createElement('div');
                productElement.classList.add('order-items');
             
                productElement.innerHTML = `
                    
                    <div class="d-flex justify-content-between mb-3 order-items" style="  flex-grow: 1; overflow-y: auto; max-height: 300px;">
                        <div class="d-flex ms-3">
                            <img src="${product.image}" alt="${product.name}" style="width: 50px; height: 50px; object-fit: cover;" class="me-3">
                            <div>
                                <p>${product.name}</p>
                                <p>PKR ${product.price}</p>
                                 ${product.size ? `<p>Size: ${product.size}</p>` : ''}

                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-outline-secondary btn-sm mx-2" onclick="updateQuantity(${index}, 'decrease')">&lt;</button>
                            <input type="number" class="form-control form-control-sm text-center" value="${product.quantity}" readonly style="width: 40px;">
                            <button class="btn btn-outline-secondary btn-sm mx-2" onclick="updateQuantity(${index}, 'increase')">&gt;</button>
                            <button class="btn btn-danger btn-sm mx-2" onclick="removeProduct(${index})">x</button>
                        </div>
                    </div>
                     
                    <div class="d-flex justify-content-between mb-3">
                        <p>Subprice</p>
                        <p id="subprice-${index}">PKR ${(product.price * product.quantity).toFixed(2)}</p>
                    </div>
                  
                `;

                orderSummary.appendChild(productElement);
                total += product.price * product.quantity;  // Calculate total price
            });

            totalPriceElement.textContent = `PKR ${total.toFixed(2)}`;  // Update total price
        }
    }

    // Function to update product quantity
    window.updateQuantity = function(index, action) {
        if (action === 'increase') {
            cart[index].quantity++;
        } else if (action === 'decrease') {
            if (cart[index].quantity > 1) {
                cart[index].quantity--;
            } else {
                cart[index].quantity = 0;  // Set quantity to 0 if it can't be decreased further
            }
        }

        // Remove product if quantity is 0
        if (cart[index].quantity === 0) {
            cart.splice(index, 1);  // Remove product from cart
        }

        localStorage.setItem("cart", JSON.stringify(cart));  // Update cart in localStorage
        renderCart();  // Re-render the cart
    }

    // Function to remove a product from the cart
    window.removeProduct = function(index) {
        cart.splice(index, 1);  // Remove product from cart
        localStorage.setItem("cart", JSON.stringify(cart));  // Update cart in localStorage
        renderCart();  // Re-render the cart
    }

    // Initial render
    renderCart();

    // Place order button event (optional, you can implement order submission logic here)
    document.getElementById("place-order-btn").addEventListener("click", function() {
        // alert("Order placed successfully!");
        // You can add more order processing logic here
    });
});

</script>
<!-- Store the form data -->
<script>
  // Retrieve cart data from localStorage
const cart = JSON.parse(localStorage.getItem('cart')) || [];

// Initialize total price
let total = 0;

// Initialize an array to hold cart data and total
let cartData = cart.map((product) => {
    const productTotal = product.price * product.quantity;  // Calculate total for this product
    total += productTotal;  // Update the total price

    return {
        name: product.name,
        image: product.image,
        price: product.price,
        quantity: product.quantity,
        size:product.size,
        total: productTotal.toFixed(2)  // Store product total formatted to 2 decimal places
    
      };
});

// Add the total price to the cart data
cartData.push({ totalPrice: total.toFixed(2) });

// Pass the cart data (with total price) into the hidden input field
document.getElementById('order').value = JSON.stringify(cartData);

</script>
<!-- Clear the local storage cart -->
<script>
  window.onload = function() {
    // Check if the URL contains "order=success"
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('order') && urlParams.get('order') === 'success') {
        // Clear the cart from local storage
        localStorage.removeItem('cart');
        console.log('Cart cleared after successful order.');
        
        // Optionally remove the query parameter from the URL to prevent re-triggering
        history.replaceState(null, null, window.location.pathname);
    }
};

</script>

<script>
  document.getElementById('sizecartInput').value = localStorage.getItem('sizecart');

</script>
<script src="{{asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> 
</body>

</html>
@endsection