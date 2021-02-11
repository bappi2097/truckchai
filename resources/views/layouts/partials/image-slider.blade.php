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
        <div class="carousel-cell">
            <img class="client-img" src="{{ asset('images/client.jpg') }}" alt="" />
        </div>
        <div class="carousel-cell">
            <img class="client-img" src="{{ asset('images/client.jpg') }}" alt="" />
        </div>
        <div class="carousel-cell">
            <img class="client-img" src="{{ asset('images/client.jpg') }}" alt="" />
        </div>
        <div class="carousel-cell">
            <img class="client-img" src="{{ asset('images/client.jpg') }}" alt="" />
        </div>
        <div class="carousel-cell">
            <img class="client-img" src="{{ asset('images/client.jpg') }}" alt="" />
        </div>
        <div class="carousel-cell">
            <img class="client-img" src="{{ asset('images/client.jpg') }}" alt="" />
        </div>
        <div class="carousel-cell">
            <img class="client-img" src="{{ asset('images/client.jpg') }}" alt="" />
        </div>
        <div class="carousel-cell">
            <img class="client-img" src="{{ asset('images/client.jpg') }}" alt="" />
        </div>
        <div class="carousel-cell">
            <img class="client-img" src="{{ asset('images/client.jpg') }}" alt="" />
        </div>
        <div class="carousel-cell">
            <img class="client-img" src="{{ asset('images/client.jpg') }}" alt="" />
        </div>
    </div>
</div>
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
