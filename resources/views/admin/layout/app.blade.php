@extends('admin.layout.master')

@push('style')
<link href="{{asset('assets/plugins/jvectormap-next/jquery-jvectormap.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/gritter/css/jquery.gritter.css')}}" rel="stylesheet" />
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