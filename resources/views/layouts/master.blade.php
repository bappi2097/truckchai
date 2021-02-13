<!DOCTYPE html>
<html {{ htmlLangDir() }}>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Traincu</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    @if (isPageRTL())
    <link rel="stylesheet" href="{{ asset('css/style-rtl.css') }}">
    @endif
</head>

<body class="bg-light-900">
    @include('layouts.partials.navbar')
    @yield('content')
    @include('layouts.partials.footer')
    <script src="{{ asset('js/frontend.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    @stack('script')
    <script src="{{asset('js/frontend.js')}}"></script>
    {!! Toastr::message() !!}
</body>

</html>