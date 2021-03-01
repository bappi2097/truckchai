<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', "Traincu | Admin")</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" crossorigin="anonymous" />
    <link href="{{ asset('assets/css/default/app.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('css/toastr.css')}}">
    @stack('style')
    <style>
        #myTable {
            margin-top: 100px;
        }

        .p-3 {
            padding: 16px !important;
        }
    </style>
</head>

<body>
    @yield('app')
    <script src="{{asset('assets/js/app.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/theme/default.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/demo/dashboard.js')}}" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="{{asset('js/toastr.js')}}"></script>
    <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    {!! Toastr::message() !!}
    @stack('script')
</body>

</html>