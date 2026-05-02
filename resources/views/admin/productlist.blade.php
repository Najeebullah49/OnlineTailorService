@extends('admin.adminlayouts.adminLayout')
@section('admincontent')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@section('title')
      Product
      @endsection</title>
   <!-- In the <head> section -->
<link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href=
    "https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"
              integrity=
    "sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg=="
              crossorigin="anonymous" 
              referrerpolicy="no-referrer" />

</head>

<body>
 
<div class="container-fluid mt-5">
    <div class="container">
        <div class="row row-cols-lg-4 row-cols-md-2 row-cols-sm-1 my-3 mx-2">
            <!-- Product 1 -->
            @forelse($productdata as $p)
            <div class="col col-lg-3 my-2">
                <div class="card">
                    <!-- Display dynamic product image if available -->
                    <img src="{{ asset($p->picture ?: 'images/adminlogo1.png') }}" alt="{{ $p->picture }}" class="img-fluid mb-3 productImg" style="object-fit: cover; width: 100%; height: 300px;">

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
        <script>
          function viewDetails(name, price, imgSrc) {
         
              localStorage.setItem('productName', name);
              localStorage.setItem('productPrice', price);
              localStorage.setItem('productImg', imgSrc);
              window.location.href = '{{route('admin.productDetails')}}';
              

          }
      </script>
     
      
   <!-- Before the closing </body> tag -->
   <script src="{{asset('css/js/bootstrap.bundle.min.js') }}"></script>
   {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}
</body>
</html>
@endsection