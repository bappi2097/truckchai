@extends('admin.layout.app')
@section('content')
    <div class="vertical-box with-grid inbox bg-light" style="height: 100vh;">
        <div class="vertical-box-column">
            <div class="vertical-box">
                <div class="vertical-box-row">

                    <div class="vertical-box-cell">

                        <div class="vertical-box-inner-cell bg-white">

                            <div class="slimScrollDiv"
                                style="position: relative; overflow: hidden; width: auto; height: 100%;">
                                <div data-scrollbar="true" data-height="100%" data-init="true"
                                    style="overflow: hidden; width: auto; height: 100%;">

                                    <ul class="list-group list-group-lg no-radius list-email">
                                        @foreach ($contacts as $item)
                                            <li class="list-group-item unread">
                                                <a href="{{ route('admin.contact.show', $item->id) }}"
                                                    class="email-user bg-blue">
                                                    <span class="text-white">F</span>
                                                </a>
                                                <div class="email-info">
                                                    <a href="{{ route('admin.contact.show', $item->id) }}">
                                                        <span class="email-sender">{{ $item->name }}</span>
                                                        <span class="email-title">{{ $item->subject }}</span>
                                                        <span class="email-desc">{{ $item->message }}</span>
                                                        <span
                                                            class="email-time">{{ time_elapsed_string($item->created_at) }}</span>
                                                    </a>
                                                </div>
                                            </li>
                                        @endforeach

                                    </ul>

                                </div>
                                <div class="slimScrollBar"
                                    style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 248.893px;">
                                </div>
                                <div class="slimScrollRail"
                                    style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <div class="wrapper clearfix d-flex align-items-center">
                    <div class="text-inverse f-w-600"></div>
                    <div class="btn-group ml-auto">
                        <a href="{{ url('admin/contact?page=1') }}" class="btn btn-white btn-sm">
                            <i class="fa fa-fw fa-chevron-left"></i>
                        </a>
                        <a href="{{ url('admin/contact?page=2') }}" class="btn btn-white btn-sm">
                            <i class="fa fa-fw fa-chevron-right"></i>
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
