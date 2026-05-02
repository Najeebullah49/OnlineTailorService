@extends('layouts.masterLayout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@section('title') Product @endsection</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"
        integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .cartTab {
            width: 400px;
            background-color: black;
            color: white;
            position: fixed;
            inset: 0 -400px 0 auto;
            display: grid;
            grid-template-rows: 70px 1fr 70px;
        }

        .cartTab h1 {
            padding: 20px;
            margin: 0;
            font-weight: 300;
        }

        .cartTab .btn1 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }

        .cartTab .btn1 button {
            border: none;
            cursor: pointer;
            font-weight: 500;
        }

        .cartTab .listCart .item img {
            width: 100%;
        }

        .cartTab .listCart .item {
            display: grid;
            grid-template-columns: 70px 150px 50px 1fr;
            text-align: center;
            align-items: center;
            margin: 20px;
        }

        .listCart .quantity span {
            display: inline-block;
            width: 25px;
            height: 25px;
            background-color: #eee;
            color: #555;
            border-radius: 50%;
            cursor: pointer;
        }

        .listCart .quantity span:nth-child(2) {
            background-color: transparent;
            color: #eee;
        }

        .listCart .item:nth-child(even) {
            background-color: #eee1;
        }

        .listCart {
            overflow: auto;
        }

        .listCart::-webkit-scrollbar {
            width: 5px;
            background-color: white;
        }

        body.showCart .cartTab {
            inset: 0 0 0 auto;
        }
    </style>
</head>

<body class="showCart">

<div class="container-fluid">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 my-3 mx-2">
            @forelse($productdata as $p)
                <div class="col my-2">
                    <div class="card">
                        <img src="{{ asset($p->picture ?: 'images/adminlogo1.png') }}" alt="{{ $p->picture ?? 'Default Image' }}" class="img-fluid mb-3 productImg" style="object-fit: cover; width: 100%; height: 300px;">

                        <div class="container">
                            <div class="row row-cols-4 g-1 px-2">
                                @if(!empty($p->optionalProducts) && $p->optionalProducts->count())
                                    @foreach($p->optionalProducts as $optional)
                                        @foreach(['optional_picture1', 'optional_picture2', 'optional_picture3', 'optional_picture4'] as $key)
                                            <div class="col">
                                                <img src="{{ asset('admin/upload/' . ($optional->$key ?? 'images/adminlogo1.png')) }}"
                                                     alt="Optional Image"
                                                     class="img-fluid productImg"
                                                     style="object-fit: cover; width: 100%; height: 40px;">
                                            </div>
                                        @endforeach
                                    @endforeach
                                @else
                                    <p class="text-muted">No optional products found.</p>
                                @endif
                            </div>
                        </div>

                        <div class="star text-center py-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>

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

                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $p->name }}</h5>
                            <h6 class="card-text">{{ $p->price }}</h6>
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
                <div class="col">
                    <p class="text-center text-muted">Product not found</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    function viewDetails(name, price, imgSrc, discription, optionalProducts) {
        @if(session()->has('id'))
            localStorage.setItem('productName', name);
            localStorage.setItem('productPrice', price);
            localStorage.setItem('productImg', imgSrc);
            localStorage.setItem('productDisc', discription);
            localStorage.setItem('optionalProducts', JSON.stringify(optionalProducts));
            window.location.href = 'readymade_Details';
        @else
            window.location.href = "{{ route('login') }}";
        @endif
    }
</script>

<script src="{{ asset('css/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
@endsection
