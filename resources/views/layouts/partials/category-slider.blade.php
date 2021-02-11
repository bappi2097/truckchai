<div id="category" class="py-5 my-5 bg-white">
    <div class="container text-center">
        <h3 class="testimonial-text">Types of Vehicle</h3>
        <div class="my-4 d-flex justify-content-center align-items-center">
            <span class="line"></span>
            <span class="square"></span>
            <span class="line"></span>
        </div>
    </div>
    <div class="category-carousel">
        <div class="carousel-cell">
            <div class="card" style="width: 18rem">
                <img class="card-img-top" src="{{ asset('images/truck.png') }}" alt="Card image cap" />
                <div class="card-body">
                    <h3>7.5 Ton Truck</h3>
                    <p class="card-text">
                        Some quick example text to build on the card title and make up
                        the bulk of the card's content.Some quick example text to build
                        on the card title and make up the bulk of the card's content.
                    </p>
                </div>
            </div>
        </div>
        <div class="carousel-cell">
            <div class="card" style="width: 18rem">
                <img class="card-img-top" src="{{ asset('images/truck-2.png') }}" alt="Card image cap" />
                <div class="card-body">
                    <h3>7.5 Ton Truck</h3>
                    <p class="card-text">
                        Some quick example text to build on the card title and make up
                        the bulk of the card's content.Some quick example text to build
                        on the card title and make up the bulk of the card's content.
                    </p>
                </div>
            </div>
        </div>
        <div class="carousel-cell">
            <div class="card" style="width: 18rem">
                <img class="card-img-top" src="{{ asset('images/truck-2.png') }}" alt="Card image cap" />
                <div class="card-body">
                    <h3>7.5 Ton Truck</h3>
                    <p class="card-text">
                        Some quick example text to build on the card title and make up
                        the bulk of the card's content.Some quick example text to build
                        on the card title and make up the bulk of the card's content.
                    </p>
                </div>
            </div>
        </div>
        <div class="carousel-cell">
            <div class="card" style="width: 18rem">
                <img class="card-img-top" src="{{ asset('images/truck-3.png') }}" alt="Card image cap" />
                <div class="card-body">
                    <h3>7.5 Ton Truck</h3>
                    <p class="card-text">
                        Some quick example text to build on the card title and make up
                        the bulk of the card's content.Some quick example text to build
                        on the card title and make up the bulk of the card's content.
                    </p>
                </div>
            </div>
        </div>
        <div class="carousel-cell">
            <div class="card" style="width: 18rem">
                <img class="card-img-top" src="{{ asset('images/truck-2.png') }}" alt="Card image cap" />
                <div class="card-body">
                    <h3>7.5 Ton Truck</h3>
                    <p class="card-text">
                        Some quick example text to build on the card title and make up
                        the bulk of the card's content.Some quick example text to build
                        on the card title and make up the bulk of the card's content.
                    </p>
                </div>
            </div>
        </div>
        <div class="carousel-cell">
            <div class="card" style="width: 18rem">
                <img class="card-img-top" src="{{ asset('images/truck.png') }}" alt="Card image cap" />
                <div class="card-body">
                    <h3>7.5 Ton Truck</h3>
                    <p class="card-text">
                        Some quick example text to build on the card title and make up
                        the bulk of the card's content.Some quick example text to build
                        on the card title and make up the bulk of the card's content.
                    </p>
                </div>
            </div>
        </div>
        <div class="carousel-cell">
            <div class="card" style="width: 18rem">
                <img class="card-img-top" src="{{ asset('images/truck-2.png') }}" alt="Card image cap" />
                <div class="card-body">
                    <h3>7.5 Ton Truck</h3>
                    <p class="card-text">
                        Some quick example text to build on the card title and make up
                        the bulk of the card's content.Some quick example text to build
                        on the card title and make up the bulk of the card's content.
                    </p>
                </div>
            </div>
        </div>
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
