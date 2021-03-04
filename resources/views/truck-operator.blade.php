@extends('layouts.master')
@section('content')
@include('layouts.partials.header-slider', ["items" => $sliders])
<div class="container py-5 my-5 text-center">
    <h3>Why Register at Traincu?</h3>
    <div class="mt-4 d-flex justify-content-center align-items-center">
        <span class="line"></span>
        <span class="square"></span>
        <span class="line"></span>
    </div>
    <div class="my-5 row">
        <div class="col-md-3 col-sm-12 why-logo">
            <img src="{{ asset('images/demo-png.png') }}" alt="Fast Booking" />
            <p>Lucrative Fare</p>
        </div>
        <div class="col-md-3 col-sm-12 why-logo">
            <img src="{{ asset('images/demo-png.png') }}" alt="Fast Booking" />
            <p>Verified Shipper</p>
        </div>
        <div class="col-md-3 col-sm-12 why-logo">
            <img src="{{ asset('images/demo-png.png') }}" alt="Fast Booking" />
            <p>No Middleman</p>
        </div>
        <div class="col-md-3 col-sm-12 why-logo">
            <img src="{{ asset('images/demo-png.png') }}" alt="Fast Booking" />
            <p>Customer Care Support</p>
        </div>
    </div>
</div>
<div id="category" class="py-5 my-5 bg-white">
    <div class="container text-center">
        <h3 class="testimonial-text">Traincu Registered Truck Operator</h3>
        <div class="my-4 d-flex justify-content-center align-items-center">
            <span class="line"></span>
            <span class="square"></span>
            <span class="line"></span>
        </div>
    </div>
    <div class="truck-operator-carousel">
        @for ($i = 0; $i < 10; $i++) <div class="carousel-cell">
            <div class="card" style="width: 18rem">
                <a class="custom-truck-operator" href="#">
                    <img class="truck-operator-img" src="{{asset('images/truck-driver.jpeg')}}" width="270" height="200"
                        alt="Card image cap" />
                    <div class="card-body">
                        <h3>Abdul Alim</h3>
                        <p class="card-text">
                            Total Trips – 31 Total Trucks – 4 Truck Type – 15 Ton 16
                            Feet(2), 15 Ton 18 Feet(2) Location - Narayanganj
                        </p>
                    </div>
                </a>
            </div>
    </div>
    @endfor
</div>
</div>
<div id="testimonial" class="py-5 my-5 bg-white">
    <div class="container text-center">
        <h3 class="testimonial-text">How Traincu Works?</h3>
        <div class="my-4 d-flex justify-content-center align-items-center">
            <span class="line"></span>
            <span class="square"></span>
            <span class="line"></span>
        </div>
        <div class="video">
            <iframe class="truck-operator-video" src="https://www.youtube.com/embed/F9st1Y76uG8" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>
    </div>
</div>
@include('layouts.partials.category-slider')
@include('layouts.partials.testimonial-slider',["title" => "How Traincu Works?"])
@include('layouts.partials.footer-hero')
@endsection
@push('script')
<script>
    $(".truck-operator-carousel").flickity({
            groupCells: true,
            freeScroll: true,
            wrapAround: true,
            groupCells: 1,
            autoPlay: 3000,
            prevNextButtons: false,
            pageDots: false,
        });

</script>
@endpush