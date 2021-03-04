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
                @foreach ($blogs as $blog)
                <div class="py-3 my-3 border b-grey-100 w-100 blog-rtl">
                    <div class="px-2 mb-3 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle" width="50"
                                src="{{ asset( !empty($blog->admin) && !empty($blog->admin->image) ? $blog->admin->image : 'images/admin.png') }}"
                                alt="admin" />
                            <span class="mx-2 text-dark font-weight-bold">{{$blog->admin->user->name}}</span>
                        </div>
                        <div class="rounded-circle date-circle">
                            <span
                                class="font-weight-bold text-grey-100 d-block">{{date("d", strtotime($blog->created_at))}}</span>
                            <span
                                class="font-weight-bold text-secondary">{{date("M", strtotime($blog->created_at))}}</span>
                        </div>
                    </div>
                    <div class="w-100">
                        <a href="{{route("single-blog", $blog->slug)}}">
                            <div class="position-relative blog-img">
                                <img width="100%" height="315" src="{{ asset($blog->image) }}" alt="" />
                                <div></div>
                            </div>
                        </a>
                    </div>
                    <div class="p-3 w-100">
                        <h4>
                            <a class="links-h" href="{{route("single-blog", $blog->slug)}}">
                                {{$blog->title}}
                            </a>
                        </h4>
                        <p>
                            {{$blog->summery}} […]
                        </p>
                        <a class="btn btn-outline-indigo"
                            href="{{route("single-blog", $blog->slug)}}">{{__('utility.read-more')}}</a>
                    </div>
                </div>
                @endforeach
                @if ($blogs->lastPage() != $blogs->currentPage())
                <div class="d-flex justify-content-center">
                    <a class="btn btn-outline-indigo"
                        href="{{$blogs->path() . '?' . $blogs->getPageName() . '=' . ($blogs->currentPage()+1)}}">
                        {{-- <span class="spinner-border spinner-border-sm">
                        </span> --}}
                        {{__('utility.show-more')}}
                    </a>
                </div>
                @endif
            </div>
            @include('blog.right-sidebar')
        </div>
    </div>
</div>
@endsection