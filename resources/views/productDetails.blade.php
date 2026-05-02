@extends('layouts.masterLayout')
@section('content')

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@section('title')
       Product Detail
        @endsection</title>
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
    <div class="container product pt-5">
        <div class="row bg-light">
<!-- Cart message area -->
<div id="cartMessage" class="text-warning mt-2 text-center" style="display:none;"></div>
    

            <div class="col col-lg-5 col-md-12 col-sm-12">
                <img src="" id="productImg" class="img-fluid rounded-start rounded-end" style="width: 440px; height: 400px;">
    
                <div class="row mt-3 d- ms-0 me-5 "  id="optional-images-container">
                         <!-- Optional images will be inserted here -->
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 ms-4">
                <h3 class="py-2" id="productName"></h3>
                <h2 id="productPrice"><h6>{{'PKR'}}</h6></h2>
             
                <input type="number" name="" id="productQuantity" value="1" class="form-control my-3">
                <button type="submit" class="btn btn-primary mb-1">Add To Cart</button>
                <h4 class="mt-2">Product Details</h4>
                <span id="productDisc"></span>
           
            </div>
        </div>
    </div>

</div>


 <!-- Related Products Section -->
 <div class="row mx-auto text-center">
        <h2 class="mt-3">Related Products</h2>
    </div>
  <div class="container-fluid">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 my-3 mx-2">
            <!-- Product 1 -->
            @forelse($productdata as $p)
            <div class="col col-lg-3 my-2">
                <div class="card">
                    <!-- Display dynamic product image if available -->
                    <!-- <img src="{{ asset('admin/product/'.$p->picture ?: 'images/adminlogo1.png') }}" alt="{{ $p->picture }}" class="img-fluid mb-3 productImg" style="object-fit: cover; width: 100%; height: 300px;" > -->
                    <img src="{{ asset($p->picture ?: 'images/adminlogo1.png') }}" alt="{{ $p->picture ?? 'Default Image' }}"  class="img-fluid mb-3 productImg"  style="object-fit: cover; width: 100%; height: 300px;">
                   
                    <div class="star text-center">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>

                        <!-- Product Data for JS -->
                        @php
                            $optionalProductsJS = [];
                            foreach ($p->optionalProducts as $optional) {
                                $optionalProductsJS[] = [
                                    'id' => $optional->id,
                                    'op1' => asset('admin/upload/' . $optional->optional_picture1),
                                    'op2' => asset('admin/upload/' . $optional->optional_picture2),
                                    'op3' => asset('admin/upload/' . $optional->optional_picture3),
                                    'op4' => asset('admin/upload/' . $optional->optional_picture4),
                                ];
                            }
                            $optionalProductsJSON = json_encode($optionalProductsJS);
                        @endphp

                        <!-- Card Content -->

                    <div class="card-body text-center">
                        <h5 class="card-title text-center productName">{{ $p->name }}</h5>
                        <h6 class="card-text text-center productPrice">{{ $p->price }} {{'PKR'}}</h6>
                        <!-- <button class="btn btn-outline-success" type="button" onclick="viewDetails('{{ $p->name }}', {{ $p->price }}, '{{ asset($p->picture  ?? 'images/cloths.jpg') }}','{{ $p->discription}}',optionalProductsArray)">Buy Now</button>
                    -->
                         <button class="btn btn-outline-success" type="button"
                                onclick='viewDetails(
                                    @json($p->name),
                                    {{ $p->price }},
                                    @json(asset($p->picture ?? "images/cloths.jpg")),
                                    @json($p->discription),
                                    {!! $optionalProductsJSON !!}
                                )'>
                                Buy Now
                            </button>
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const optionalContainer = document.getElementById('optional-images-container');
        const optionalProducts = JSON.parse(localStorage.getItem('optionalProducts'));

        if (optionalProducts && optionalProducts.length > 0) {
            optionalProducts.forEach(product => {
                [product.op1, product.op2, product.op3, product.op4].forEach((imgSrc) => {
                    if (imgSrc) {
                        const col = document.createElement('div');
                        col.className = "col-lg-3 col-md-3 col col-sm-3 my-2";

                        const img = document.createElement('img');
                        img.src = imgSrc;
                        img.className = "rounded-start custom-size rounded-end img-fluid smallImg";
                        img.alt = "Optional Product";

                        col.appendChild(img);
                        optionalContainer.appendChild(col);
                    }
                });
            });
        }
    });
</script>



     <!-- Script -->
<script>
    function viewDetails(name, price, imgSrc, discription, optionalProducts) {
        @if(session()->has('id'))
            localStorage.setItem('productName', name);
            localStorage.setItem('productPrice', price);
            localStorage.setItem('productImg', imgSrc);
            localStorage.setItem('productDisc', discription);
            localStorage.setItem('optionalProducts', JSON.stringify(optionalProducts));
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
    let cartMessage = document.getElementById('cartMessage');
    if (existingProductIndex > -1) {
    if (cart[existingProductIndex].quantity > 0) {
        // If the product already exists in the cart and has a valid quantity, show the alert
                    cartMessage.innerText = 'Product already exists in the cart.';
    cartMessage.style.display = 'block';
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
    document.addEventListener("DOMContentLoaded", function () {
        const mainImg = document.getElementById('productImg');
        const smallImgs = document.getElementsByClassName('smallImg');

        for (let i = 0; i < smallImgs.length; i++) {
            smallImgs[i].addEventListener('click', function () {
                mainImg.src = this.src;
            });
        }
    });
</script>


 <!-- this fetch data from local strage that sved in product details class -->
<script>
        document.addEventListener('DOMContentLoaded', function() {
        var productName = localStorage.getItem('productName');
        var productPrice = localStorage.getItem('productPrice');
        var productImg = localStorage.getItem('productImg');
        var productDisc = localStorage.getItem('productDisc');
        document.getElementById('productName').textContent = productName;
        document.getElementById('productPrice').textContent = productPrice;
        document.getElementById('productImg').src = productImg;
        document.getElementById('productDisc').textContent = productDisc;
    });
</script><!-- this fetch data from local strage that sved in product details class -->

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



         
   <!-- Before the closing </body> tag -->
   <script src="{{asset('css/js/bootstrap.bundle.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}



</body>
</html>
@endsection