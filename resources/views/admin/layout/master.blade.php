<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" crossorigin="anonymous" />
    <link href="assets/css/default/app.min.css" rel="stylesheet" />
    <link href="assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
</head>

<body>
    <!-- <div id="page-loader" class="fade show">
      <span class="spinner"></span>
    </div> -->

    <div id="page-container" class=" page-sidebar-fixed page-header-fixed">
        @include('admin.layout.partials.navbar')

        @include('admin.layout.partials.sidebar')
        <div class="sidebar-bg"></div>

        <div id="content" class="content">
            @include('admin.layout.partials.breadcrumb')
            <h1 class="page-header">
                @yield('header')
                {{-- Dashboard <small>header small text goes here...</small> --}}
            </h1>
            <div class="row">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="assets/js/app.min.js" type="text/javascript"></script>
    <script src="assets/js/theme/default.min.js" type="text/javascript"></script>
    <script src="assets/js/demo/dashboard.js" type="text/javascript"></script>
</body>


</html>
