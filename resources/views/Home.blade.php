@extends('layouts.masterLayout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@section('title')
     Home
    @endsection</title>
    
    <style>
      .carousel-image {
        width: 100%; /* Ensure the image takes up full width */
        height: 670px; /* Default height for larger screens */
        object-fit: cover; /* Ensure the image fills the container without distortion */
      }

      /* Media query for tablets */
      @media (max-width: 768px) {
        .carousel-image {
          height: 450px; /* Adjust height for tablets */
        }
      }

      /* Media query for mobile devices */
      @media (max-width: 576px) {
        .carousel-image {
          height: 300px; /* Adjust height for smaller screens */
        }
      }
    </style>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
<div class="carousel slide" id="carouselDemo" data-bs-wrap="true" data-bs-ride="carousel">
  <div class="carousel-inner">
    <!-- Carousel Items -->
    @foreach (['cloths1.jpg', 'cloths2.jpg', 'cloths3.jpg', 'cloths5.jpg', 'cloths6.jpg', 'cloths7.jpg', 'cloths8.jpg', 'cloths9.jpg', 'cloths10.jpg', 'cloths11.jpg', 'cloths12.jpg', 'cloths13.jpg'] as $key => $image)
      <div class="carousel-item {{ $key === 0 ? 'active' : '' }}" data-bs-interval="2000">
        <img src="{{ asset('images/' . $image) }}" class="carousel-image" alt="Slide {{ $key + 1 }}">
        <div class="carousel-caption">
        
        </div>
      </div>
    @endforeach
  </div>

  <!-- Controls -->
  <button type="button" class="carousel-control-prev" data-bs-target="#carouselDemo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon bg-dark border rounded border-light"></span>
  </button>
  <button type="button" class="carousel-control-next" data-bs-target="#carouselDemo" data-bs-slide="next">
    <span class="carousel-control-next-icon bg-dark border rounded border-light"></span>
  </button>
</div>

<script src="{{ asset('css/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@section('title') About Us @endsection</title>
    <link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>

<div class="container-fluid">
    <div class="row bg-light align-items-center row-cols-1 row-cols-md-2">
        <div class="col p-4">
            <h1 class="display-4">We make cloths</h1>
            <h1 class="display-4">That suit you</h1>
            <p class="lead mt-4">It is a responsive and helpful store to provide
                variety of designs as per customer's choice and provides 20% of discount. Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                Tenetur at quas laboriosam optio. Distinctio reprehenderit, illo ipsam quis maiores tempora eos debitis nisi animi voluptates a enim laudantium amet ab?
            </p>
        </div>
        <div class="col text-center">
            <img src="{{ asset('images/cloths1.jpg') }}" class="img-fluid rounded shadow my-3" alt="about us">
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row row-cols-1 row-cols-md-2 align-items-center">
        <div class="col">
            <h2 class="display-5">Our Story</h2>
            <p class="lead mt-3">At Online Tailor Service, we believe that every individual deserves clothing tailored to their unique style and measurements. Our journey began with a passion for creating custom-fit designs that combine elegance, comfort, and quality. From handpicking premium fabrics to delivering the perfect fit, we aim to make your experience seamless and personal. Whether it’s for everyday wear or a special occasion, our expert craftsmanship ensures you always look and feel your best. Join us in redefining tailoring—one stitch at a time!</p>
        </div>
        <div class="col text-center">
            <img src="{{asset('images/cloths3.jpg')}}" alt="Owner" class="img-fluid rounded my-3">
            <p class="lead">Najeeb Tailor</p>
        </div>
    </div>
</div>

<div class="container-fluid bg-light py-5">
    <div class="container">
        <h2 class="display-5 mb-5 text-center">Our Colleagues</h2>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @php
                $team = [
                    ['name' => 'Mr. Najeeb Ullah', 'img' => 'images/download.PNG', 'desc' => 'Najeeb Ullah is a skilled tailor master with 10 years of experience in the art of cutting and sewing fabric to perfection. His attention to detail ensures every piece fits flawlessly, tailored to the customer’s unique needs.'],
                    ['name' => 'Mr. Sajjad Khan', 'img' => 'images/sajjad.png', 'desc' => 'Sajjad Khan is a dedicated and talented craftsman, specializing in sewing garments with precision and care.'],
                    ['name' => 'Mr. Ali Hassan', 'img' => 'images/alihassan.PNG', 'desc' => 'Ali Hassan is a skilled craftsman known for his exceptional attention to detail and creativity.'],
                    ['name' => 'Mr. Asif Nawaz Khan', 'img' => 'images/asif.jpg', 'desc' => 'Asif Nawaz Khan is a diligent and efficient cashier working with an online tailor service, ensuring seamless financial transactions.']
                ];
            @endphp

            @foreach ($team as $member)
                <div class="col text-center">
                    <img src="{{ asset($member['img']) }}" class="img-fluid rounded-circle border border-primary mb-3" alt="{{ $member['name'] }}" style="width: 200px; height: 200px; object-fit: cover;">
                    <h5 class="lead">{{ $member['name'] }}</h5>
                    <p class="small">{{ $member['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script src="{{asset('css/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>


@endsection
