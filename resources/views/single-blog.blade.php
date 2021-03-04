@extends('layouts.master')
@section('content')
<div class="h-5 bg-white w-100 text-rtl">
    <div class="container">
        <div class="row">
            <div class="px-3 col-md-8 clo-sm-12 mt-4">
                <img class="img-fluid w-100" src="{{asset($blog->image)}}" alt="{{$blog->title}}" />
                <h4 class="mt-4">
                    {{$blog->title}}
                </h4>
                <div class="d-flex align-items-center">
                    <span>
                        <img width="14" src="{{asset('images/calendar.svg')}}" alt="" />
                    </span>
                    <span class="mx-1 text-muted" style="font-size: 12px">On
                        {{date("F j, Y", strtotime($blog->created_at))}}</span>
                </div>
                <div class="mt-4">
                    {!!$blog->description!!}
                </div>
            </div>
            @include('blog.right-sidebar')
        </div>
    </div>
</div>
@endsection