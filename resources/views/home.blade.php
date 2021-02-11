@extends('layouts.master')

@section('content')
    @include('layouts.partials.header-slider', ["header_slider_imgs" => [
    "images/slider/slider-1.jpg",
    "images/slider/slider-2.jpg",
    "images/slider/slider-3.jpg",
    "images/slider/slider-4.jpg",
    ]])
    @include('layouts.partials.blog-list')
    @include('layouts.partials.testimonial-slider', ["title" => "frontend/home.testimonials"])
    @include('layouts.partials.image-slider')
    @include('layouts.partials.category-slider')
    <div class="container py-5 my-5 text-center">
        <h3>{{ __('frontend/home.latest-news') }}</h3>
        <p class="custom-index-blog-p">{{ __('frontend/home.read-our-blog') }}</p>
        <div class="mt-4 d-flex justify-content-center align-items-center">
            <span class="line"></span>
            <span class="square"></span>
            <span class="line"></span>
        </div>
        <div class="row custom-index-blog">
            <div class="mt-5 row">
                <div class="p-0 col-md-5 col-sm-12">
                    <img class="img-fluid w-100" src="{{ asset('images/blog-2.jpg') }}" alt="blog title" />
                </div>
                <div class="p-5 text-left col-md-7 col-sm-12 card text-rtl">
                    <h5 class="custom-index-blog-title">
                        <a href="./single-blog.html">
                            HOW ARLA FOODS IS ENSURING THE BEST RATES FOR SHIPPING THEIR
                            PRODUCTS ACROSS THE COUNTRY
                        </a>
                    </h5>
                    <div class="custom-index-blog-admin">
                        <p>{{ __('utility.by') }}:: Admin</p>
                        <p class="mx-2">{{ __('utility.comments') }}:: 0</p>
                    </div>
                    <div>
                        <span class="seperator"></span>
                        <span class="ml-3 seperator"></span>
                    </div>
                    <p class="custom-index-blog-p">
                        On May 22, 2020 According to the data required to run the business
                        for more than 3 years, it is possible to reduce the cost in the
                        transport sector of Bangladesh by up to 30% if the business
                        organizations transport goods through an efficient transportation
                        system. Most of the time truck rentals are not stable in […]
                    </p>
                </div>
            </div>
            <div class="custom-index-blog-date">
                <span>
                    JUL
                    <br />
                    11
                </span>
            </div>
        </div>
        <div class="row custom-index-blog">
            <div class="mt-5 row">
                <div class="p-0 col-md-5 col-sm-12">
                    <img class="img-fluid w-100" src="{{ asset('images/blog-2.jpg') }}" alt="blog title" />
                </div>
                <div class="p-5 text-left col-md-7 col-sm-12 card text-rtl">
                    <h5 class="custom-index-blog-title">
                        <a href="./single-blog.html">
                            IT ENHANCES TRUCKING EFFICIENCY, REDUCES POLLUTION AND WANDERING
                            ON EMPTY TRUCKS
                        </a>
                    </h5>
                    <div class="custom-index-blog-admin">
                        <p>{{ __('utility.by') }}:: Admin</p>
                        <p class="mx-2">{{ __('utility.comments') }}:: 0</p>
                    </div>
                    <div>
                        <span class="seperator"></span>
                        <span class="ml-3 seperator"></span>
                    </div>
                    <p class="custom-index-blog-p">
                        Truck drivers sometimes have to travel thousands of kilometers
                        with empty trucks, which results in the production of millions of
                        tons of carbon emissions. For example, when trucks transport loads
                        to a specific place, they may return empty after emptying their
                        load due to the lack of a new load, so the application of Traincu
                        […]
                    </p>
                </div>
            </div>
            <div class="custom-index-blog-date">
                <span>
                    JUL
                    <br />
                    11
                </span>
            </div>
        </div>
        <div class="row custom-index-blog">
            <div class="mt-5 row">
                <div class="p-0 col-md-5 col-sm-12">
                    <img class="img-fluid w-100" src="{{ asset('images/blog-2.jpg') }}" alt="blog title" />
                </div>
                <div class="p-5 text-left col-md-7 col-sm-12 card text-rtl">
                    <h5 class="custom-index-blog-title">
                        <a href="./single-blog.html">
                            IT ENHANCES TRUCKING EFFICIENCY, REDUCES POLLUTION AND WANDERING
                            ON EMPTY TRUCKS
                        </a>
                    </h5>
                    <div class="custom-index-blog-admin">
                        <p>{{ __('utility.by') }}:: Admin</p>
                        <p class="mx-2">{{ __('utility.comments') }}:: 0</p>
                    </div>
                    <div>
                        <span class="seperator"></span>
                        <span class="ml-3 seperator"></span>
                    </div>
                    <p class="custom-index-blog-p">
                        Truck drivers sometimes have to travel thousands of kilometers
                        with empty trucks, which results in the production of millions of
                        tons of carbon emissions. For example, when trucks transport loads
                        to a specific place, they may return empty after emptying their
                        load due to the lack of a new load, so the application of Traincu
                        […]
                    </p>
                </div>
            </div>
            <div class="custom-index-blog-date">
                <span>
                    JUL
                    <br />
                    11
                </span>
            </div>
        </div>
        <a href="#" class="mt-5 btn btn-outline-indigo">{{ __('utility.more') }}</a>
    </div>
    @include('layouts.partials.footer-hero')
@endsection
