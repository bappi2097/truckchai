<nav class="bg-purple-300 shadow-lg navbar navbar-dark navbar-expand-lg sticky-top">
    <a class="text-white navbar-brand" href="./index.html">
        <img src="{{ asset('images/logo.png') }}" alt="" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
        aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="text-white navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="mt-2 ml-auto navbar-nav mt-lg-0 nav-rtl">
            <li class="nav-item active">
                <a class="text-white nav-link" href="./index.html">{{ __('frontend/navbar.home') }}</a>
            </li>
            <li class="nav-item">
                <a class="text-white nav-link" href="./truck-operator.html">
                    {{ __('frontend/navbar.truck-operator') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="text-white nav-link" href="./blog.html">
                    {{ __('frontend/navbar.blog') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="text-white nav-link" href="./contact-us.html">
                    {{ __('frontend/navbar.contact-us') }}
                </a>
            </li>
            @auth
                <li class="nav-item">
                    <a class="text-white nav-link" href="./dashboard.html">{{ __('frontend/navbar.dashboard') }}</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="text-white nav-link" href="./sign-in.html">{{ __('frontend/navbar.login') }}</a>
                </li>
                <li class="nav-item">
                    <a class="text-white nav-link" href="./sign-in.html">{{ __('frontend/navbar.register') }}</a>
                </li>
            @endauth
            <li class="nav-item dropdown">
                <a class="text-white nav-link dropdown-toggle d-flex align-items-center" href="#"
                    data-toggle="dropdown">
                    <span>
                        <img class="lang-icon" src="{{ asset('images/flag/uk.svg') }}" alt="English" />
                    </span>
                    <span class="mx-1"> ENGLISH </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="javascript:void(0)">
                            <img class="lang-icon" src="{{ asset('images/flag/uk.svg') }}" alt="English" />
                            <span>English</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="javascript:void(0)">
                            <img class="lang-icon" src="{{ asset('images/flag/uae.svg') }}" alt="English" />
                            <span>العربية</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
