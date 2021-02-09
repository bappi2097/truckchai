<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Traincu</title>
    <link rel="shortcut icon" href="./assets/img/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <!-- CSS -->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css" />
    <link rel="stylesheet" href="./assets/css/custom.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body class="bg-light-900">
    @include('frontend.layout.partials.navbar')
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="assets/img/slider/slider-1.jpg" alt="First slide" />
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="assets/img/slider/slider-2.jpg" alt="Second slide" />
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="assets/img/slider/slider-3.jpg" alt="Third slide" />
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="assets/img/slider/slider-4.jpg" alt="Third slide" />
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container py-5 my-5 text-center">
        <h3>Why Choose Traincu?</h3>
        <div class="mt-4 d-flex justify-content-center align-items-center">
            <span class="line"></span>
            <span class="square"></span>
            <span class="line"></span>
        </div>
        <div class="row custom-index-blog">
            <div class="mt-5 row">
                <div class="p-0 col-md-5 col-sm-12">
                    <img class="img-fluid w-100" src="./assets/img/why.jpeg" alt="blog title" />
                </div>
                <div class="p-5 text-left col-md-7 col-sm-12 card text-rtl">
                    <h5 class="custom-index-blog-title">
                        <a href="./single-blog.html">
                            IT ENHANCES TRUCKING EFFICIENCY, REDUCES POLLUTION AND WANDERING
                            ON EMPTY TRUCKS
                        </a>
                    </h5>
                    <div class="custom-index-blog-admin">
                        <p>BY:: Admin</p>
                        <p class="mx-2">COMMENTS:: 0</p>
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
                    <img class="img-fluid w-100" src="./assets/img/why.jpeg" alt="blog title" />
                </div>
                <div class="p-5 text-left col-md-7 col-sm-12 card text-rtl">
                    <h5 class="custom-index-blog-title">
                        <a href="./single-blog.html">
                            IT ENHANCES TRUCKING EFFICIENCY, REDUCES POLLUTION AND WANDERING
                            ON EMPTY TRUCKS
                        </a>
                    </h5>
                    <div class="custom-index-blog-admin">
                        <p>BY:: Admin</p>
                        <p class="mx-2">COMMENTS:: 0</p>
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
                    <img class="img-fluid w-100" src="./assets/img/why.jpeg" alt="blog title" />
                </div>
                <div class="p-5 text-left col-md-7 col-sm-12 card text-rtl">
                    <h5 class="custom-index-blog-title">
                        <a href="./single-blog.html">
                            IT ENHANCES TRUCKING EFFICIENCY, REDUCES POLLUTION AND WANDERING
                            ON EMPTY TRUCKS
                        </a>
                    </h5>
                    <div class="custom-index-blog-admin">
                        <p>BY:: Admin</p>
                        <p class="mx-2">COMMENTS:: 0</p>
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
        <a href="#" class="mt-5 btn btn-outline-indigo">More</a>
    </div>
    <div id="testimonial" class="py-5 my-5 bg-white">
        <div class="container text-center">
            <h3 class="testimonial-text">Testimonials</h3>
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
                        <img class="testimonial-img" src="./assets/img/user150x150.jpg" alt="" />
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
                        <img class="testimonial-img" src="./assets/img/user150x150.jpg" alt="" />
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
                        <img class="testimonial-img" src="./assets/img/user150x150.jpg" alt="" />
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
    <div id="client" class="py-5 my-5">
        <div class="container text-center">
            <h3 class="testimonial-text">Our Clients</h3>
            <div class="my-4 d-flex justify-content-center align-items-center">
                <span class="line"></span>
                <span class="square"></span>
                <span class="line"></span>
            </div>
        </div>
        <div class="client-carousel">
            <div class="carousel-cell">
                <img class="client-img" src="./assets/img/client.jpg" alt="" />
            </div>
            <div class="carousel-cell">
                <img class="client-img" src="./assets/img/client.jpg" alt="" />
            </div>
            <div class="carousel-cell">
                <img class="client-img" src="./assets/img/client.jpg" alt="" />
            </div>
            <div class="carousel-cell">
                <img class="client-img" src="./assets/img/client.jpg" alt="" />
            </div>
            <div class="carousel-cell">
                <img class="client-img" src="./assets/img/client.jpg" alt="" />
            </div>
            <div class="carousel-cell">
                <img class="client-img" src="./assets/img/client.jpg" alt="" />
            </div>
            <div class="carousel-cell">
                <img class="client-img" src="./assets/img/client.jpg" alt="" />
            </div>
            <div class="carousel-cell">
                <img class="client-img" src="./assets/img/client.jpg" alt="" />
            </div>
            <div class="carousel-cell">
                <img class="client-img" src="./assets/img/client.jpg" alt="" />
            </div>
            <div class="carousel-cell">
                <img class="client-img" src="./assets/img/client.jpg" alt="" />
            </div>
        </div>
    </div>
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
                    <img class="card-img-top" src="./assets/img/truck.png" alt="Card image cap" />
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
                    <img class="card-img-top" src="./assets/img/truck-2.png" alt="Card image cap" />
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
                    <img class="card-img-top" src="./assets/img/truck-2.png" alt="Card image cap" />
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
                    <img class="card-img-top" src="./assets/img/truck-3.png" alt="Card image cap" />
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
                    <img class="card-img-top" src="./assets/img/truck-2.png" alt="Card image cap" />
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
                    <img class="card-img-top" src="./assets/img/truck.png" alt="Card image cap" />
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
                    <img class="card-img-top" src="./assets/img/truck-2.png" alt="Card image cap" />
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
    <div class="container py-5 my-5 text-center">
        <h3>LATEST NEWS</h3>
        <p class="custom-index-blog-p">READ OUR LATEST BLOG</p>
        <div class="mt-4 d-flex justify-content-center align-items-center">
            <span class="line"></span>
            <span class="square"></span>
            <span class="line"></span>
        </div>
        <div class="row custom-index-blog">
            <div class="mt-5 row">
                <div class="p-0 col-md-5 col-sm-12">
                    <img class="img-fluid w-100" src="./assets/img/blog-2.jpg" alt="blog title" />
                </div>
                <div class="p-5 text-left col-md-7 col-sm-12 card text-rtl">
                    <h5 class="custom-index-blog-title">
                        <a href="./single-blog.html">
                            HOW ARLA FOODS IS ENSURING THE BEST RATES FOR SHIPPING THEIR
                            PRODUCTS ACROSS THE COUNTRY
                        </a>
                    </h5>
                    <div class="custom-index-blog-admin">
                        <p>BY:: Admin</p>
                        <p class="mx-2">COMMENTS:: 0</p>
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
                    <img class="img-fluid w-100" src="./assets/img/blog-2.jpg" alt="blog title" />
                </div>
                <div class="p-5 text-left col-md-7 col-sm-12 card text-rtl">
                    <h5 class="custom-index-blog-title">
                        <a href="./single-blog.html">
                            IT ENHANCES TRUCKING EFFICIENCY, REDUCES POLLUTION AND WANDERING
                            ON EMPTY TRUCKS
                        </a>
                    </h5>
                    <div class="custom-index-blog-admin">
                        <p>BY:: Admin</p>
                        <p class="mx-2">COMMENTS:: 0</p>
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
                    <img class="img-fluid w-100" src="./assets/img/blog-2.jpg" alt="blog title" />
                </div>
                <div class="p-5 text-left col-md-7 col-sm-12 card text-rtl">
                    <h5 class="custom-index-blog-title">
                        <a href="./single-blog.html">
                            IT ENHANCES TRUCKING EFFICIENCY, REDUCES POLLUTION AND WANDERING
                            ON EMPTY TRUCKS
                        </a>
                    </h5>
                    <div class="custom-index-blog-admin">
                        <p>BY:: Admin</p>
                        <p class="mx-2">COMMENTS:: 0</p>
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
        <a href="#" class="mt-5 btn btn-outline-indigo">More</a>
    </div>
    <div class="main-end">
        <div class="py-5 text-center row text-light w-100">
            <div class="col-md-6">
                <h3 class="mb-5">Hire a truck Now</h3>
                <a class="btn btn-danger btn-lg" href="#">Hire Truck</a>
            </div>
            <div class="col-md-6">
                <h3 class="mb-3">Download the App</h3>
                <a href="#" class="btn btn-lg">
                    <img src="./assets/img/play-store.png" alt="" />
                </a>
            </div>
        </div>
    </div>
    <footer class="bg-white">
        <div class="container">
            <div class="py-5 row">
                <div class="col-md-3 col-sm-12">
                    <img class="logo" src="./assets/img/logo.png" alt="" />
                    <p class="mt-4 text-dark">
                        Hotline: +880 9638 000 245 Copyright © 2019-2020 Traincu <br />
                        All Rights Reserved
                    </p>
                </div>
                <div class="col-md-3 col-sm-12">
                    <h4 class="mb-4">Quick Links</h4>
                    <a class="custoom-footer-link" href="./privacy-and-policy.html">Privacy & Policy</a>
                    <a class="custoom-footer-link" href="./contact-us.html">Contact Us</a>
                    <a class="custoom-footer-link" href="./terms-and-condition.html">Terms & Condition</a>
                </div>
                <div class="col-md-3 col-sm-12">
                    <h4 class="mb-4">Menu</h4>
                    <a class="custoom-footer-link" href="./truck-operator.html">Truck Operator</a>
                    <a class="custoom-footer-link" href="./faq.html">FAQ</a>
                    <a class="custoom-footer-link" href="./blog.html">Blog</a>
                </div>
                <div class="col-md-3 col-sm-12">
                    <h4 class="mb-4">Newsletter</h4>
                    <p class="text-dark">
                        Please subscribe to receive news, updates & exclusive promotions
                    </p>
                    <div class="mb-3 input-group">
                        <input type="text" class="form-control" placeholder="john.doe@email.com"
                            aria-describedby="basic-addon2" />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <span class="custom-newsletter-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        xmlns:svgjs="http://svgjs.com/svgjs" version="1.1" width="18" height="18" x="0"
                                        y="0" viewBox="0 0 24 24" style="enable-background: new 0 0 512 512"
                                        xml:space="preserve" class="">
                                        <g>
                                            <path xmlns="http://www.w3.org/2000/svg"
                                                d="m8.75 17.612v4.638c0 .324.208.611.516.713.077.025.156.037.234.037.234 0 .46-.11.604-.306l2.713-3.692z"
                                                fill="#ffffff" data-original="#000000" />
                                            <path xmlns="http://www.w3.org/2000/svg"
                                                d="m23.685.139c-.23-.163-.532-.185-.782-.054l-22.5 11.75c-.266.139-.423.423-.401.722.023.3.222.556.505.653l6.255 2.138 13.321-11.39-10.308 12.419 10.483 3.583c.078.026.16.04.242.04.136 0 .271-.037.39-.109.19-.116.319-.311.352-.53l2.75-18.5c.041-.28-.077-.558-.307-.722z"
                                                fill="#ffffff" data-original="#000000" />
                                        </g>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                    <h4>Social Links</h4>
                    <div class="flex-wrap d-flex">
                        <a href="#">
                            <img class="custom-social-icon" src="./assets/img/facebook.svg" alt="" />
                        </a>
                        <a href="#">
                            <img class="custom-social-icon" src="./assets/img/twitter.svg" alt="" />
                        </a>
                        <a href="#">
                            <img class="custom-social-icon" src="./assets/img/youtube.svg" alt="" />
                        </a>
                        <a href="#">
                            <img class="custom-social-icon" src="./assets/img/whatsapp.svg" alt="" />
                        </a>
                        <a href="#">
                            <img class="custom-social-icon" src="./assets/img/linkedin.svg" alt="" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="./assets/js/app.js"></script>
    <!-- JavaScript -->
    <script>
        $(".carousel").carousel({
            interval: 2000,
        });
        $(".client-carousel").flickity({
            groupCells: true,
            freeScroll: true,
            wrapAround: true,
            groupCells: 1,
            autoPlay: 3000,
        });
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
    <script>
        document.re;

    </script>
</body>

</html>
