@extends('admin.layout.master')

@push('style')
    <link href="assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
@endpush

@section('app')
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
@endsection

@push('script')
    <script src="assets/js/app.min.js" type="text/javascript"></script>
    <script src="assets/js/theme/default.min.js" type="text/javascript"></script>
    <script src="assets/js/demo/dashboard.js" type="text/javascript"></script>
@endpush
