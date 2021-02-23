<div id="testimonial" class="py-5 my-5 bg-white">
    <div class="container text-center">
        <h3 class="testimonial-text">{{ __($title) }}</h3>
        <div class="my-4 d-flex justify-content-center align-items-center">
            <span class="line"></span>
            <span class="square"></span>
            <span class="line"></span>
        </div>
    </div>
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="testimonial-slide">
                    <div class="mx-auto w-50">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde
                            praesentium incidunt ex expedita aliquam quas, consectetur
                            magnam ipsum totam eligendi! Lorem ipsum dolor sit amet
                            consectetur adipisicing elit. Unde
                        </p>
                    </div>
                    <img class="testimonial-img" src="{{ asset('images/truck-driver.jpeg') }}" alt="" />
                    <p>John Doe</p>
                </div>
            </div>
            <div class="carousel-item">
                <div class="testimonial-slide">
                    <div class="mx-auto w-50">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde
                            praesentium incidunt ex expedita aliquam quas, consectetur
                            magnam ipsum totam eligendi! praesentium incidunt ex expedita
                            aliquam quas, consectetur
                        </p>
                    </div>
                    <img class="testimonial-img" src="{{ asset('images/truck-driver.jpeg') }}" alt="" />
                    <p>John Doe</p>
                </div>
            </div>
            <div class="carousel-item">
                <div class="testimonial-slide">
                    <div class="mx-auto w-50">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde
                            praesentium incidunt ex expedita aliquam quas, consectetur
                            magnam ipsum totam eligendi! magnam ipsum totam eligendi!
                        </p>
                    </div>
                    <img class="testimonial-img" src="{{ asset('images/truck-driver.jpeg') }}" alt="" />
                    <p>John Doe</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>