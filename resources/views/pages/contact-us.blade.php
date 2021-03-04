@extends('layouts.master')
@section('content')
<div class="custom-contact-map">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d927764.356640459!2d46.26200415062901!3d24.724150177962223!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f03890d489399%3A0xba974d1c98e79fd5!2sRiyadh%20Saudi%20Arabia!5e0!3m2!1sen!2sbd!4v1597582784526!5m2!1sen!2sbd"
        width="100%" height="100%" frameborder="0" style="border: 0" allowfullscreen="" aria-hidden="false"
        tabindex="0"></iframe>
</div>
<div class="container mt-5">
    <div class="my-5 row">
        <div class="mx-auto text-center text-rtl col-md-8 col-sm-12 d-flex justify-content-center">
            <h5 class="text-purple">
                {{__('utility.feel-free-to-message')}}
            </h5>
        </div>
    </div>
    <div class="row text-rtl">
        <div class="mx-auto col-md-6 col-sm-12">
            <form method="POST" action="{{route("contact-store")}}">
                @csrf
                <div class="form-group">
                    <label for="name">{{__('utility.full-name')}}</label>
                    <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelp"
                        required />
                </div>
                <div class="form-group">
                    <label for="email">{{__('utility.email-address')}}</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                        required />
                </div>
                <div class="form-group">
                    <label for="subject">{{__('utility.subject')}}</label>
                    <input type="text" class="form-control" name="subject" id="subject" aria-describedby="emailHelp"
                        required />
                </div>
                <div class="form-group">
                    <label for="message">{{__('utility.message')}}</label>
                    <textarea class="form-control" name="message" id="message" cols="30" rows="5" required></textarea>
                </div>
                <div class="form-group d-flex">
                    <button type="submit" class="mx-auto btn btn-outline-indigo">
                        {{__('utility.send')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection