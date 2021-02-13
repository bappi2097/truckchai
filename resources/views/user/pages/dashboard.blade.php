@extends('user.layout.master')
@section('content')
<div class="p-0 col-md-9 col-sm-12">
    <div class="p-2 shadow-lg">
        <div class="m-0 row text-rtl">
            <div class="col-md-6 col-sm-12">
                <div class="p-3 py-4 m-2 bg-red-600 rounded shadow-lg cost-trip">
                    <h3 class="text-light-900">Total Cost</h3>
                    <h4 class="px-3 text-light-900">9000 SR</h4>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="p-3 py-4 m-2 bg-yellow-700 rounded shadow-lg number-trip">
                    <h3 class="text-light-900">Total Trip</h3>
                    <h4 class="px-3 text-light-900">120+</h4>
                </div>
            </div>
        </div>
        <h2 class="p-5 text-center">Welocome To Dashboard</h2>
    </div>
</div>
@endsection