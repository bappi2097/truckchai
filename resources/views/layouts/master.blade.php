<!DOCTYPE html>
<html {{ htmlLangDir() }}>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Traincu</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
    @if (isPageRTL())
    <link rel="stylesheet" href="{{ asset('css/style-rtl.css') }}">
    @endif
    <link rel="stylesheet" href="{{asset('css/toastr.css')}}" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet" />
</head>

<body class="bg-light-900">
    @include('layouts.partials.navbar')
    @yield('content')
    @include('layouts.partials.footer')
    <script src="{{ asset('js/frontend.js') }}"></script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/flickity.js')}}"></script>
    @stack('script')
    <script src="{{asset('js/frontend.js')}}"></script>
    <script src="{{asset('js/toastr.js')}}"></script>
    {!! Toastr::message() !!}
</body>

</html>