@extends('admin.layout.app')
@section('title', "Dashboard | Admin")
@section('header')
Dashboard <small>header small text goes here...</small>
@endsection
@section('content')

<div class="col-xl-3 col-md-6">
    <div class="widget widget-stats bg-blue">
        <div class="stats-icon"><i class="fa fa-users"></i></div>
        <div class="stats-info">
            <h4>TOTAL USURS</h4>
            <p>{{$total_user}}</p>
        </div>
        <div class="stats-link">
            <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
        </div>
    </div>
</div>


<div class="col-xl-3 col-md-6">
    <div class="widget widget-stats bg-info">
        <div class="stats-icon"><i class="fas fa-lg fa-fw fa-truck"></i></div>
        <div class="stats-info">
            <h4>TOTALTRIP</h4>
            <p>{{$total_trip}}</p>
        </div>
        <div class="stats-link">
            <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
        </div>
    </div>
</div>


<div class="col-xl-3 col-md-6">
    <div class="widget widget-stats bg-orange">
        <div class="stats-icon"><i class="fas fa-lg fa-fw fa-money-bill-alt"></i></div>
        <div class="stats-info">
            <h4>TOTAL TRANSECTION</h4>
            <p>{{$total_transection}}</p>
        </div>
        <div class="stats-link">
            <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
        </div>
    </div>
</div>


<div class="col-xl-3 col-md-6">
    <div class="widget widget-stats bg-red">
        <div class="stats-icon"><i class="fa fa-clock"></i></div>
        <div class="stats-info">
            <h4>TOTAL BID</h4>
            <p>{{$total_bid}}</p>
        </div>
        <div class="stats-link">
            <a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
        </div>
    </div>
</div>

@endsection