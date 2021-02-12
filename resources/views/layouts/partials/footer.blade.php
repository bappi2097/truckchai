<footer class="bg-white">
    <div class="container">
        <div class="py-5 row">
            <div class="col-md-3 col-sm-12">
                <img class="logo" src="{{ asset('images/logo.png') }}" alt="" />
                <p class="mt-4 text-dark">
                    Hotline: +880 9638 000 245 <br> {{ __('frontend/footer.copyright') }} <br />
                    {{ __('frontend/footer.right-reserved') }}
                </p>
            </div>
            <div class="col-md-3 col-sm-12">
                <h4 class="mb-4">{{ __('frontend/footer.quick-links') }}</h4>
                <a class="custoom-footer-link"
                    href="{{route('privacy-and-policy')}}">{{ __('frontend/footer.privacy-policy') }}</a>
                <a class="custoom-footer-link" href="{{route('contact-us')}}">{{ __('frontend/footer.contact-us') }}</a>
                <a class="custoom-footer-link"
                    href="{{route('terms-and-condition')}}">{{ __('frontend/footer.terms-condition') }}</a>
            </div>
            <div class="col-md-3 col-sm-12">
                <h4 class="mb-4">{{ __('frontend/footer.menu') }}</h4>
                <a class="custoom-footer-link"
                    href="{{route('truck-operator')}}">{{ __('frontend/footer.truck-operator') }}</a>
                <a class="custoom-footer-link" href="{{route('faq')}}">{{ __('frontend/footer.faq') }}</a>
                <a class="custoom-footer-link" href="{{route('blog')}}">{{ __('frontend/footer.blog') }}</a>
            </div>
            <div class="col-md-3 col-sm-12">
                <h4 class="mb-4">{{ __('frontend/footer.newsletter') }}</h4>
                <p class="text-dark">
                    {{ __('frontend/footer.subscribe-newsletter') }}
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
                <h4>{{ __('frontend/footer.social-links') }}</h4>
                <div class="flex-wrap d-flex">
                    <a href="#">
                        <img class="custom-social-icon" src="{{ asset('images/facebook.svg') }}" alt="" />
                    </a>
                    <a href="#">
                        <img class="custom-social-icon" src="{{ asset('images/twitter.svg') }}" alt="" />
                    </a>
                    <a href="#">
                        <img class="custom-social-icon" src="{{ asset('images/youtube.svg') }}" alt="" />
                    </a>
                    <a href="#">
                        <img class="custom-social-icon" src="{{ asset('images/whatsapp.svg') }}" alt="" />
                    </a>
                    <a href="#">
                        <img class="custom-social-icon" src="{{ asset('images/linkedin.svg') }}" alt="" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>