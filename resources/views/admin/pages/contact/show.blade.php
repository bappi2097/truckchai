@extends('admin.layout.app')
@section('content')

    <div class="vertical-box with-grid inbox bg-light" style="height: 50vh;">
        <div class="vertical-box-row bg-white">

            <div class="vertical-box-cell">

                <div class="vertical-box-inner-cell">

                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
                        <div data-scrollbar="true" data-height="100%" style="overflow: hidden; width: auto; height: 100%;"
                            data-init="true">

                            <div class="wrapper">
                                <h3 class="m-t-0 m-b-15 f-w-500">{{ $contact->subject }}</h3>
                                <ul class="media-list underline m-b-15 p-b-15">
                                    <li class="media media-sm clearfix">
                                        <a href="javascript:;" class="pull-left">
                                            <img class="media-object rounded-corner" alt="{{ $contact->name }}"
                                                src="{{ asset('assets/img/user/user-1.jpg') }}">
                                        </a>
                                        <div class="media-body">
                                            <div class="email-from text-inverse f-s-14 m-b-3 f-w-600">
                                                from: {{ $contact->email }} {{ $contact->name }}
                                            </div>
                                            <div class="m-b-3"><i class="fa fa-clock fa-fw"></i>
                                                {{ time_elapsed_string($contact->created_at) }}
                                            </div>
                                            <div class="email-to">
                                                To: {{ auth()->user()->email }}
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <p class="text-inverse">
                                    {{ $contact->message }}
                                </p>
                            </div>

                        </div>
                        <div class="slimScrollBar"
                            style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 7px; position: absolute; top: -1px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 436.903px;">
                        </div>
                        <div class="slimScrollRail"
                            style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;">
                        </div>
                    </div>

                </div>

            </div>
            <form class="d-flex justify-content-end" action="{{ route('admin.contact.destroy', $contact->id) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-lg mt-3">Delete</button>
            </form>
        </div>



    @endsection
