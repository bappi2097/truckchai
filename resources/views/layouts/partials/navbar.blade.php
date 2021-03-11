<nav class="bg-purple-300 shadow-lg navbar navbar-dark navbar-expand-lg sticky-top">
    <a class="text-white navbar-brand" href="{{ route('home') }}">
        <img src="{{ asset('images/logo.png') }}" alt="" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="text-white navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
        <ul class="mt-2 ml-auto navbar-nav mt-lg-0 nav-rtl">
            <li class="nav-item {{ active('home') }}">
                <a class="text-white nav-link" href="{{ route('home') }}">{{ __('frontend/navbar.home') }}</a>
            </li>
            <li class="nav-item">
                <a class="text-white nav-link {{ active('truck-operator') }}" href="{{ route('truck-operator') }}">
                    {{ __('frontend/navbar.truck-operator') }}
                </a>
            </li>
            <li class="nav-item {{ active('blog') }}">
                <a class="text-white nav-link" href="{{ route('blog') }}">
                    {{ __('frontend/navbar.blog') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="text-white nav-link {{ active('contact-us') }}" href="{{ route('contact-us') }}">
                    {{ __('frontend/navbar.contact-us') }}
                </a>
            </li>
            @auth
            <li class="nav-item">
                <a class="text-white nav-link {{ active('customer.dashboard') }}"
                    href="{{dashboardURL()}}">{{ __('frontend/navbar.dashboard') }}</a>
            </li>
            <li class="nav-item">
                <a class="text-white nav-link text-uppercase" href="javascript:void(0)"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{__('utility.logout')}}</a>
                <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            @else
            <li class="nav-item">
                <a class="text-white nav-link {{ active('auth.login') }}"
                    href="{{ route('auth.login') }}">{{ __('frontend/navbar.login') }}</a>
            </li>
            <li class="nav-item">
                <a class="text-white nav-link {{ active('auth.register') }}"
                    href="{{ route('auth.register') }}">{{ __('frontend/navbar.register') }}</a>
            </li>
            @endauth
            @auth
            <li class="nav-item dropdown mt-1">
                <a class="text-white nav-link dropdown-toggle d-flex align-items-center" href="javascript:void(0)"
                    data-toggle="dropdown">
                    <i class="icon-bell-alt position-absolute mt-1"></i>
                    @if (auth()->user()->hasNotification())
                    <span class="red-dot"></span>
                    @endif
                </a>
                @if (auth()->user()->hasNotification())
                <ul class="dropdown-menu dropdown-menu-right w-300p">
                    @foreach (auth()->user()->notifications->where("is_seen", false) as $item)
                    <li class="text-wrap w-300p">
                        <a class="dropdown-item text-wrap"
                            href="{{ route(auth()->user()->roles->first()->name . '.notification', $item->id) }}">
                            {!! $item->text !!}
                            {!! "<div class='text-primary float-right'> " . time_elapsed_string($item->created_at)
                                . "
                            </div>" !!}
                        </a>
                    </li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endauth
            <li class="nav-item dropdown">
                <a class="text-white nav-link dropdown-toggle d-flex align-items-center" href="javascript:void(0)"
                    data-toggle="dropdown">
                    @foreach (\App\Models\Language::all() as $item)
                    @if (app()->getLocale() == $item->code)
                    <span>
                        <img class="lang-icon" src="{{ asset($item->logo) }}" alt="{{$item->name}}" />
                    </span>
                    <span class="mx-1"> {{$item->name}} </span>
                    @endif
                    @endforeach
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    @foreach (\App\Models\Language::all() as $item)
                    <li>
                        <a class="dropdown-item d-flex align-items-center"
                            href="{{ join($item->code, explode(app()->getLocale(), \Request::url(), 2)) }}">
                            <img class="lang-icon" src="{{ asset($item->logo) }}" alt="{{$item->name}}" />
                            <span>{{$item->name}}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
</nav>