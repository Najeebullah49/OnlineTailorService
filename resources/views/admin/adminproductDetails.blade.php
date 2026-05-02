@extends('admin.adminlayouts.adminLayout')
@section('admincontent')

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@section('title')
       Product Detail
        @endsection</title>
    <!-- In the <head> section -->
 <link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet">
 
     {{-- <link rel="stylesheet" href=
     "https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"
               integrity=
     "sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg=="
               crossorigin="anonymous" 
               referrerpolicy="no-referrer" /> --}}

    <style>
       
        .product select{
            display: block;
            padding: 5px 10px;
        }
        .product input{
            width: 50px;
            height: 40px;
            padding-left: 10px;
            margin-right: 10px;
            font-size: 16px;
        }
        .product input :focus{
            outline: none;
        }
        .product button{
            background-color: rgb(14, 15, 15);
            transition: 0.3s all;
            height: 40px;
            color: white;
        }

        .custom-size {
            width: 60px;
            height: 60px;
            object-fit: cover;
        }
    </style>
 

</head>

<body>
    
 <div class="container-fluid"> 
 <div class="container-fluid mt-5">  
<div class="container-fluid mt-5">
    <div class="container product pt-5">
        <div class="row bg-light">
            <div class="col col-lg-5 col-md-12 col-sm-12">
                <img src="" id="productImg" class="img-fluid rounded-start rounded-end" style="width: 440px; height: 400px;">
                <div class="row mt-3 d-flex ms-0  me-5">
                    <div class="col-lg-3 col-md-3 col-sm-3 my-2">
                        <img src="{{asset('images/cloths1.jpg')}}" class="rounded-start  custom-size rounded-end img-fluid smallImg" alt="">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 my-2">
                        <img src="{{asset('images/cloths2.jpg')}}" class="rounded-start custom-size rounded-end img-fluid smallImg" alt="">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 my-2">
                        <img src="{{asset('images/cloths3.jpg')}}" class="rounded-start custom-size rounded-end img-fluid smallImg" alt="">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 my-2">
                        <img src="{{asset('images/cloths4.jpg')}}" class="rounded-start custom-size rounded-end img-fluid smallImg" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 ms-4">
                <h3 class="py-2" id="productName"></h3>
                <h2 id="productPrice"></h2>
             
                <input type="number" name="" id="productQuantity" value="1" class="form-control my-3">
                <button type="submit" class="btn btn-primary mb-1">Add To Cart</button>
                <h4 class="mt-2">Product Details</h4>
                <span>Its the best quality cotton. that remain his color for a long time.</span>
            </div>
        </div>
    </div>

</div>


 <!-- Related Products Section -->
 <div class="row  text-center">
        <h2 class="mt-3">Related Products</h2>
    </div>
  <div class="container-fluid">
    <div class="container">
        <div class="row row-cols-lg-4 row-cols-md-2 row-cols-sm-1 my-3 mx-2">
            <!-- Product 1 -->
            @forelse($productdata as $p)
            <div class="col col-lg-3 my-2">
                <div class="card">
                    <!-- Display dynamic product image if available -->
                    <img src="{{ asset($p->picture ?: 'images/adminlogo1.png') }}" alt="{{ $p->picture }}" class="img-fluid mb-3 productImg" style="object-fit: cover; width: 100%; height: 300px;" >

                    <div class="star text-center">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title text-center productName">{{ $p->name }}</h5>
                        <h6 class="card-text text-center productPrice">{{ $p->price }}</h6>
                        <button class="btn btn-outline-success" type="button" onclick="viewDetails('{{ $p->name }}', {{ $p->price }}, '{{ asset($p->picture  ?? 'images/cloths.jpg') }}')">Buy Now</button>
                    </div>
                </div>
            </div>
                             @empty
                     					   <tr>
                           					 <td colspan="20" class="text-center text-muted">Product not found</td>
                       					   </tr>
                   						    @endforelse
           
        </div>
    </div>
</div>


     
    </div>
    </div> 
    </div> 
    <script>
         
         function viewDetails(name, price, imgSrc) 
      {
       @if(session()->has('id'))
      localStorage.setItem('productName', name);
      localStorage.setItem('productPrice', price);
      localStorage.setItem('productImg', imgSrc);
      window.location.href = 'productDetails';
  @else
  window.location.href = "{{ route('login') }}";
  @endif
       }
   </script>

<script>
// Initialize cart as an empty array or get existing cart from localStorage
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Function to add a product to the cart
function addToCart(product) {
    const existingProductIndex = cart.findIndex(item => item.name === product.name && item.price === product.price);
    if (existingProductIndex > -1) {
    if (cart[existingProductIndex].quantity > 0) {
        // If the product already exists in the cart and has a valid quantity, show the alert
        alert('Product already exists in the cart'); 
    } else {
        // Remove the product if it has a quantity of 0
        cart.splice(existingProductIndex, 1);
        localStorage.setItem('cart', JSON.stringify(cart)); // Update the cart in localStorage
        updateCartDisplay(); // Refresh the cart display
        // Add the product as a new product
        cart.push(product);
        localStorage.setItem('cart', JSON.stringify(cart)); // Save updated cart to localStorage
        updateCartDisplay(); // Update the cart display
    }
} else {
    // If the product does not exist in the cart, add it as a new product
    cart.push(product); 
    localStorage.setItem('cart', JSON.stringify(cart)); // Save updated cart to localStorage
    updateCartDisplay(); // Update the cart display
}



}

// Add event listener to the "Add to Cart" button
document.querySelector('.btn-primary').addEventListener('click', function () {
    const productName = document.getElementById('productName').textContent;
    const productPrice = document.getElementById('productPrice').textContent;
    const productQuantity = document.querySelector('.product input').value;
    const productImgSrc = document.getElementById('productImg').src;
    
    // Create a product object
    const product = {
        image: productImgSrc,
        name: productName,
        price: parseFloat(productPrice.replace('$', '')), // Ensure price is a number
        quantity: parseInt(productQuantity, 10) || 1 // Ensure the quantity is a number
    };

    addToCart(product); // Add product to the cart
});


</script>


   

 <script>
 var mainImg = document.getElementById('productImg');
 var smallImg = document.getElementsByClassName('smallImg');
 smallImg[0].onclick = function(){
mainImg.src = smallImg[0].src;
 }

 smallImg[1].onclick = function(){
mainImg.src = smallImg[1].src;
 }

 smallImg[2].onclick = function(){
mainImg.src = smallImg[2].src;
 }

 smallImg[3].onclick = function(){
mainImg.src = smallImg[3].src;
 }

 </script>

 <!-- this fetch data from local strage that sved in product details class -->
<script>
        document.addEventListener('DOMContentLoaded', function() {
        var productName = localStorage.getItem('productName');
        var productPrice = localStorage.getItem('productPrice');
        var productImg = localStorage.getItem('productImg');

        document.getElementById('productName').textContent = productName;
        document.getElementById('productPrice').textContent = productPrice;
        document.getElementById('productImg').src = productImg;
    });
</script><!-- this fetch data from local strage that sved in product details class -->


         
   <!-- Before the closing </body> tag -->
   <script src="{{asset('css/js/bootstrap.bundle.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}



</body>
</html>
@endsection