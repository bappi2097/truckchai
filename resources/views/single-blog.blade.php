@extends('layouts.master')
@section('content')
<div class="h-5 bg-white w-100 text-rtl">
    <div class="container">
        <div class="row">
            <div class="px-3 col-md-8 clo-sm-12">
                <img class="img-fluid" src="{{asset('images/blog-1.jpg')}}" alt="" />
                <h4 class="mt-4">
                    BACHELOR HOME SHIFT: 6 THINGS YOU SHOULD KNOW BEFORE SHIFTING
                </h4>
                <div class="d-flex align-items-center">
                    <span>
                        <img width="14" src="./assets/img/calendar.svg" alt="" />
                    </span>
                    <span class="mx-1 text-muted" style="font-size: 12px">On January 24, 2021</span>
                </div>
                <div class="mt-4">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea porro
                    voluptates cum laborum reiciendis corrupti itaque incidunt
                    dignissimos minima quasi debitis tenetur asperiores minus vitae
                    nostrum, pariatur, officia animi quibusdam non commodi ipsum esse!
                    Quas veritatis eius temporibus numquam. Omnis eligendi impedit
                    minima autem alias doloribus pariatur qui sequi facere! Lorem
                    ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate,
                    neque totam voluptate aperiam tenetur facere officia vitae
                    necessitatibus perspiciatis placeat et atque ad, nisi deserunt
                    nihil sapiente est maxime, id culpa minima asperiores dolore.
                    Tempore, minima amet non fugit nostrum eius magni blanditiis
                    tempora. Tempore asperiores nam enim fuga sit sapiente sequi!
                    Labore reprehenderit praesentium eum quis nam dolorum
                    voluptatibus?
                </div>
            </div>
            @include('blog.right-sidebar')
        </div>
    </div>
</div>
@endsection