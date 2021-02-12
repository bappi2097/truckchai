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
                FEEL FREE TO SEND US A MESSAGE OR ASK FOR A FREE QUOTE
            </h5>
        </div>
    </div>
    <div class="row text-rtl">
        <div class="mx-auto col-md-6 col-sm-12">
            <form>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" aria-describedby="emailHelp" />
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" />
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" id="subject" aria-describedby="emailHelp" />
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" name="message" id="message" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group d-flex">
                    <button type="submit" class="mx-auto btn btn-outline-indigo">
                        Send
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection