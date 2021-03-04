@extends('layouts.master')

@section('content')
@include('layouts.partials.header-slider', ["items" => $sliders])
@include('layouts.partials.blog-list')
{{-- @include('layouts.partials.testimonial-slider', ["title" => "frontend/home.testimonials"]) --}}
{{-- @include('layouts.partials.image-slider') --}}
<div id="client" class="py-5 my-5">
    <div class="container text-center">
        <h3 class="testimonial-text">{{ __('frontend/home.our-clients') }}</h3>
        <div class="my-4 d-flex justify-content-center align-items-center">
            <span class="line"></span>
            <span class="square"></span>
            <span class="line"></span>
        </div>
    </div>
    <div class="client-carousel">
        @foreach ($clients as $item)
        <div class="carousel-cell">
            <img class="client-img" src="{{ asset($item->image) }}" alt="{{$item->name}}" />
        </div>
        @endforeach
    </div>
</div>
@include('layouts.partials.category-slider', ["truckCategories" => $truckCategories])
<div id="latest-blogs-spinner" class="row justify-content-center my-5">
    <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<div id="latest-blogs-div" class="container py-5 my-5 text-center d-none">
    <h3>{{ __('frontend/home.latest-news') }}</h3>
    <p class="custom-index-blog-p">{{ __('frontend/home.read-our-blog') }}</p>
    <div class="mt-4 d-flex justify-content-center align-items-center">
        <span class="line"></span>
        <span class="square"></span>
        <span class="line"></span>
    </div>
    <div class="latest-blogs"> </div>
    <a href="{{route('blog')}}" class="mt-5 btn btn-outline-indigo">{{ __('utility.more') }}</a>
</div>
@include('layouts.partials.footer-hero')
@endsection
@push('script')
<script>
    $( document ).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        $("why-blogs-load").on("click", latestBlogs());
        function latestBlogs(){
            $.ajax({
                url: "{{route('latest-blogs')}}",
                type: 'GET',
                success: function( data ){
                    if(!$.isEmptyObject(data)){
                        $("#latest-blogs-div").removeClass("d-none");
                    }
                    $("#latest-blogs-spinner").addClass("d-none");
                    data.forEach((element) => {
                        $(".latest-blogs").append(
                            `
                            <div class="row custom-index-blog">
                                <div class="mt-5 row">
                                    <div class="p-0 col-md-5 col-sm-12">
                                        <img class="img-fluid w-100 h-100" src="{{ asset( '${element.image}') }}" alt="${element.title}" />
                                    </div>
                                    <div class="p-5 text-left col-md-7 col-sm-12 card text-rtl">
                                        <h5 class="custom-index-blog-title">
                                            <a href="{{url( 'en' . '/single-blog/' . '${element.slug}')}}">
                                                ${element.title}
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
                                            ${element.summery}
                                            […]
                                        </p>
                                    </div>
                                </div>
                                <div class="custom-index-blog-date">
                                    <span class="text-wrap">
                                        ${element.created.split(' ').join("<br>")}
                                    </span>
                                </div>
                            </div>
                            `
                        );
                    })
                }
            });
        }
    });
    $(".client-carousel").flickity({
        groupCells: true,
        freeScroll: true,
        wrapAround: true,
        groupCells: 1,
        autoPlay: 3000,
    });

</script>
@endpush