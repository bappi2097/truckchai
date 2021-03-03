<!DOCTYPE html>
<html {{ htmlLangDir() }}>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Traincu</title>
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/toastr.css')}}" />
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.css')}}">
    @if (isPageRTL())
    <link rel="stylesheet" href="{{ asset('css/style-rtl.css') }}">
    @endif
    @stack('style')
</head>

<body>
    @include('layouts.partials.navbar')
    <div class="m-0 mt-2 row">
        @include('driver.layout.partials.sidebar')
        @yield('content')
    </div>
    <script src="{{asset('js/app.js')}}"></script>
    {{-- <l src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></l> --}}
    <script src="{{asset('js/frontend.js')}}"></script>
    <script src="{{asset('js/toastr.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.js')}}"></script>
    {!! Toastr::message() !!}
    @stack('script')
</body>

</html>