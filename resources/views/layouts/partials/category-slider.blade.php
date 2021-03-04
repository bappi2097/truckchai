<div id="category" class="py-5 my-5 bg-white">
    <div class="container text-center">
        <h3 class="testimonial-text">{{ __('frontend/home.types-of-vehicle') }}</h3>
        <div class="my-4 d-flex justify-content-center align-items-center">
            <span class="line"></span>
            <span class="square"></span>
            <span class="line"></span>
        </div>
    </div>
    <div class="category-carousel">
        @foreach ($truckCategories as $item)
        <div class="carousel-cell">
            <div class="card" style="width: 18rem">
                <img class="card-img-top" src="{{ asset( $item->image ?: 'images/truck.png') }}" alt="Card image cap" />
                <div class="card-body">
                    <h3>{{$item->truckWeightCategory->weight}} Ton Truck</h3>
                    <p class="card-text">
                        {{$item->description}}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@push('script')
<script>
    $(".category-carousel").flickity({
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