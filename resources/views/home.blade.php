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
                    <img class="client-img" src="{{ asset($item->image) }}" alt="{{ $item->name }}" />
                </div>
            @endforeach
        </div>
    </div>
    @include('layouts.partials.category-slider', ["truckCategories" => $truckCategories])

    <div id="latest-blogs-div" class="container py-5 my-5 text-center">
        <h3>{{ __('frontend/home.latest-news') }}</h3>
        <p class="custom-index-blog-p">{{ __('frontend/home.read-our-blog') }}</p>
        <div class="mt-4 d-flex justify-content-center align-items-center">
            <span class="line"></span>
            <span class="square"></span>
            <span class="line"></span>
        </div>
        <div class="latest-blogs">
            @if (!empty($blogs))
                @foreach ($blogs as $item)
                    <div class="row custom-index-blog">
                        <div class="mt-5 row">
                            <div class="p-0 col-md-5 col-sm-12">
                                <img class="img-fluid w-100 h-100" src="{{ asset($item->image) }}"
                                    alt="{{ $item->title }}" />
                            </div>
                            <div class="p-5 text-left col-md-7 col-sm-12 card text-rtl">
                                <h5 class="custom-index-blog-title">
                                    <a href="{{ url(app()->getLocale() . '/single-blog/' . $item->slug) }}">
                                        {{ $item->title }}
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
                                    {{ $item->summery }}
                                    […]
                                </p>
                            </div>
                        </div>
                        <div class="custom-index-blog-date">
                            <span class="text-wrap">
                                {{ $item->created }}
                            </span>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <a href="{{ route('blog') }}" class="mt-5 btn btn-outline-indigo">{{ __('utility.more') }}</a>
    </div>
    @include('layouts.partials.footer-hero')
@endsection
@push('script')
    <script>
        $(".client-carousel").flickity({
            groupCells: true,
            freeScroll: true,
            wrapAround: true,
            groupCells: 1,
            autoPlay: 3000,
        });

    </script>
@endpush
