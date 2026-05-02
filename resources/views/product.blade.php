@extends('layouts.masterLayout')
@section('title', 'Product')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"
        integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<div class="container-fluid">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-4 g-4 my-3 mx-2">
            @forelse($productdata as $p)
                <div class="col">
                    <div class="card h-100">
                        <!-- Product Image -->
                        <img src="{{ asset($p->picture ?: 'images/adminlogo1.png') }}"
                             alt="{{ $p->picture ?? 'Default Image' }}"
                             class="img-fluid mb-3 productImg"
                             style="object-fit: cover; width: 100%; height: 300px;">

                        <!-- Optional Product Images -->
                        <div class="container">
                            <div class="row row-cols-4 g-2 mb-3">
                                @if(!empty($p->optionalProducts) && $p->optionalProducts->count())
                                    @foreach($p->optionalProducts as $optional)
                                        @foreach(['optional_picture1', 'optional_picture2', 'optional_picture3', 'optional_picture4'] as $key)
                                            <div class="col">
                                                <img src="{{ asset('admin/upload/' . ($optional->$key ?? 'images/adminlogo1.png')) }}"
                                                     alt="Optional Image"
                                                     class="img-fluid productImg"
                                                     style="object-fit: cover; width: 100%; height: 30px;">
                                            </div>
                                        @endforeach
                                    @endforeach
                                @else
                                    <p class="text-muted">No optional products found.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Star Rating -->
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
                            <h5 class="card-title productName">{{ $p->name }}</h5>
                            <h6 class="card-text productPrice">{{ $p->price }}</h6>
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
                <div class="col-12 text-center text-muted">
                    <p>Product not found</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

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

<!-- JS Bundle -->
<script src="{{ asset('css/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
@endsection
