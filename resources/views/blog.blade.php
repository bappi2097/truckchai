@extends('layouts.master')
@section('content')
<div class="container my-3">
    <div class="d-flex justify-content-between">
        <h3 class="text-uppercase">{{__('utility.blog')}}</h3>
        <ol class="p-0 m-0 breadcrumb bg-light-900">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('utility.home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('utility.blog')}}</li>
        </ol>
    </div>
</div>
<div class="h-5 bg-white w-100">
    <div class="container">
        <div class="row">
            <div class="col-md-8 clo-sm-12">
                @for ($i = 0; $i < 10; $i++) <div class="py-3 my-3 border b-grey-100 w-100 blog-rtl">
                    <div class="px-2 mb-3 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle" width="50" src="{{ asset('images/admin.png') }}" alt="admin" />
                            <span class="mx-2 text-dark font-weight-bold">Admin</span>
                        </div>
                        <div class="rounded-circle date-circle">
                            <span class="font-weight-bold text-grey-100 d-block">24</span>
                            <span class="font-weight-bold text-secondary">JAN</span>
                        </div>
                    </div>
                    <div class="w-100">
                        <a href="./single-blog.html">
                            <div class="position-relative blog-img">
                                <img width="100%" height="315" src="{{ asset('images/blog-1.jpg') }}" alt="" />
                                <div></div>
                            </div>
                        </a>
                    </div>
                    <div class="p-3 w-100">
                        <h4>
                            <a class="links-h" href="./single-blog.html">
                                BACHELOR HOME SHIFT: 6 THINGS YOU SHOULD KNOW BEFORE
                                SHIFTING
                            </a>
                        </h4>
                        <p>
                            In Dhaka city, numerous families and bachelors shift their
                            home every month. In the case of family home shifting, every
                            family member has the opportunity to share the
                            responsibilities together. But a bachelor has to take care of
                            everything on his or her own when it comes to shifting. So
                            even if the goods are […]
                        </p>
                        <a class="btn btn-outline-indigo" href="#">{{__('utility.read-more')}}</a>
                    </div>
            </div>
            @endfor
            <div class="w-100">
                <form action="/" class="d-flex">
                    <button class="mx-auto btn btn-outline-indigo">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true">
                        </span>
                        {{__('utility.show-more')}}
                    </button>
                </form>
            </div>
        </div>
        @include('blog.right-sidebar')
    </div>
</div>
</div>
@endsection