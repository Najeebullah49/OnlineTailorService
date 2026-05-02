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
    <title>Online Tailor Service</title>

</head>

<body>
  
    
<div class="container-fluid">

    <div class="container product pt-5">
        <div class="row bg-light">

                <div id="sizeError" class="text-danger mt-2 text-center" style="display:none;"></div>
<!-- Cart message area -->
<div id="cartMessage" class="text-warning mt-2 text-center" style="display:none;"></div>
            <div class="col col-lg-5 col-md-12 col-sm-12">
                <img src="" id="productImg" class="img-fluid rounded-start rounded-end" style="width: 440px; height: 400px;">
               
                     <div class="row  mt-3 d-flex ms-0 me-5 "  id="optional-images-container">
                         <!-- Optional images will be inserted here -->
                </div>
                
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 ms-4">
                <h3 class="py-2" id="productName"></h3>
                <h2 id="productPrice"></h2>
                <div class="mb-3" style="width:200px;">
    <label for="sizeSelect" class="form-label">Select Size</label>
    <select id="sizeSelect" class="form-select">
        <option value="" selected class="text-center">Select Size</option>
        <option value="XXS">XXS</option>
        <option value="XS">XS</option>
        <option value="SM">SM</option>
        <option value="MD">MD</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
    </select>
</div>

                <input type="number" name="" id="productQuantity" value="1" class="form-control my-3">
                <button type="submit" class="btn btn-primary mb-1">Add To Cart</button>
                <h4 class="mt-2">Product Details</h4>
                <span>Its the best quality cotton. that remain his color for a long time.</span>
            </div>
        </div>
    </div>

</div>



<div class="container my-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold">Ready-Made Shalwar Qameez Measurements</h1>
            <p class="text-muted">Find the perfect fit for all age ranges and sizes!</p>
        </div>

        <!-- Table Header -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Category</th>
                        <th>Size</th>
                        <th>Chest (in)</th>
                        <th>Shoulders (in)</th>
                        <th>Sleeve Length (in)</th>
                        <th>Qameez Length (in)</th>
                        <th>Shalwar Waist (in)</th>
                        <th>Shalwar Length (in)</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- 1–5 Years -->
                    <tr>
                        <td rowspan="2">1–5 Years (Baby)</td>
                        <td>Small</td>
                        <td>20–22</td>
                        <td>9–10</td>
                        <td>12–13</td>
                        <td>18–20</td>
                        <td>15–17</td>
                        <td>20–22</td>
                    </tr>
                    <tr>
                        <td>Large</td>
                        <td>23–25</td>
                        <td>10–11</td>
                        <td>14–15</td>
                        <td>21–23</td>
                        <td>18–20</td>
                        <td>23–25</td>
                    </tr>

                    <!-- 5–10 Years -->
                    <tr>
                        <td rowspan="2">5–10 Years (Boy)</td>
                        <td>Small</td>
                        <td>26–28</td>
                        <td>11–12</td>
                        <td>15–16</td>
                        <td>24–26</td>
                        <td>21–23</td>
                        <td>26–28</td>
                    </tr>
                    <tr>
                        <td>Large</td>
                        <td>29–31</td>
                        <td>12–13</td>
                        <td>17–18</td>
                        <td>27–29</td>
                        <td>24–26</td>
                        <td>29–31</td>
                    </tr>

                    <!-- 10–15 Years -->
                    <tr>
                        <td rowspan="2">10–15 Years (Teen)</td>
                        <td>Small</td>
                        <td>32–34</td>
                        <td>13–14</td>
                        <td>19–20</td>
                        <td>30–32</td>
                        <td>26–28</td>
                        <td>32–34</td>
                    </tr>
                    <tr>
                        <td>Large</td>
                        <td>35–37</td>
                        <td>14–15</td>
                        <td>21–22</td>
                        <td>33–35</td>
                        <td>29–31</td>
                        <td>35–37</td>
                    </tr>

                    <!-- 15–20 Years -->
                    <tr>
                        <td rowspan="2">15–20 Years (Teen/Adult)</td>
                        <td>Medium</td>
                        <td>38–40</td>
                        <td>16–17</td>
                        <td>23–24</td>
                        <td>37–39</td>
                        <td>32–34</td>
                        <td>39–41</td>
                    </tr>
                    <tr>
                        <td>Large</td>
                        <td>41–43</td>
                        <td>17–18</td>
                        <td>25–26</td>
                        <td>40–42</td>
                        <td>35–37</td>
                        <td>42–44</td>
                    </tr>

                    <!-- Adults -->
                    <tr>
                        <td rowspan="6">Adults (20+ Years)</td>
                        <td>XXS</td>
                        <td>34–36</td>
                        <td>15</td>
                        <td>22</td>
                        <td>38</td>
                        <td>30–32</td>
                        <td>38</td>
                    </tr>
                    <tr>
                        <td>XS</td>
                        <td>37–39</td>
                        <td>16</td>
                        <td>23</td>
                        <td>39</td>
                        <td>33–35</td>
                        <td>39</td>
                    </tr>
                    <tr>
                        <td>SM</td>
                        <td>40–42</td>
                        <td>17</td>
                        <td>24</td>
                        <td>40</td>
                        <td>36–38</td>
                        <td>40</td>
                    </tr>
                    <tr>
                        <td>MD</td>
                        <td>43–45</td>
                        <td>18</td>
                        <td>25</td>
                        <td>42</td>
                        <td>39–41</td>
                        <td>42</td>
                    </tr>
                    <tr>
                        <td>L</td>
                        <td>46–48</td>
                        <td>19</td>
                        <td>26</td>
                        <td>44</td>
                        <td>42–44</td>
                        <td>44</td>
                    </tr>
                    <tr>
                        <td>XL</td>
                        <td>49–51</td>
                        <td>20</td>
                        <td>27</td>
                        <td>46</td>
                        <td>45–47</td>
                        <td>46</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

<script>
// Initialize cart as an empty array or get existing cart from localStorage
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Function to add a product to the cart
function addToCart(product) {
    const existingProductIndex = cart.findIndex(item => item.name === product.name && item.size === product.size && item.price === product.price);
let cartMessage = document.getElementById('cartMessage');
    if (existingProductIndex > -1) {
        if (cart[existingProductIndex].quantity > 0) {
             cartMessage.innerText = 'Product already exists in the cart.';
    cartMessage.style.display = 'block';

        }
        
        
        else {
            cart.splice(existingProductIndex, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartDisplay();
            cart.push(product);
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartDisplay();
        }
    } else {
        cart.push(product); 
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartDisplay();
    }
}

// Add event listener to the "Add to Cart" button
document.querySelector('.btn-primary').addEventListener('click', function () {
    const productName = document.getElementById('productName').textContent;
    const productPrice = document.getElementById('productPrice').textContent;
    const productQuantity = document.querySelector('.product input').value;
    const productImgSrc = document.getElementById('productImg').src;
const productSize = document.getElementById('sizeSelect').value;

  let sizeError = document.getElementById('sizeError');

    if (!productSize) {
        sizeError.innerText = 'Please select a size before adding to cart.';
        sizeError.style.display = 'block';
        return;
    } else {
        sizeError.style.display = 'none';
    }

    // Create a product object
    const product = {
        image: productImgSrc,
        name: productName,
        price: parseFloat(productPrice.replace('$', '')),
        quantity: parseInt(productQuantity, 10) || 1,
        size: productSize // ✅ Save size
    };

    addToCart(product); // Add to cart
});
</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const mainImg = document.getElementById('productImg');
        const optionalContainer = document.getElementById('optional-images-container');

        // Event delegation: attach one listener to the container
        optionalContainer.addEventListener('click', function (event) {
            const target = event.target;
            if (target.classList.contains('smallImg')) {
                mainImg.src = target.src;
            }
        });
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
                        img.className = "rounded-start custom-size rounded-end img-fluid smallImg ";
                        img.alt = "Optional Product";

                        col.appendChild(img);
                        optionalContainer.appendChild(col);
                    }
                });
            });
        }
    });
</script>
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