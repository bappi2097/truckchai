<div class="container py-5 my-5 text-center" id="why-blogs-div">
    <h3>{{ __('frontend/home.why-choose-traincu') }}</h3>
    <div class="mt-4 d-flex justify-content-center align-items-center">
        <span class="line"></span>
        <span class="square"></span>
        <span class="line"></span>
    </div>

    <div class="row">
        <h4>{{__('utility.enables')}}</h4>
        <div class="col-md-6">
            <img src="{{asset('images/save-time.png')}}" alt="" class="img-fluid"><br>
            {{__('utility.save-time')}}
        </div>
        <div class="col-md-6">
            <img src="{{asset('images/rent.png')}}" alt="" class="img-fluid"><br>
            {{__('utility.rent')}}
        </div>
        <div class="col-md-6">
            <img src="{{asset('images/rates.png')}}" alt="" class="img-fluid"><br>
            {{__('utility.rates')}}
        </div>
        <div class="col-md-6">
            <img src="{{asset('images/take.png')}}" alt="" class="img-fluid"><br>
            {{__('utility.take')}}
        </div>
    </div>
</div>