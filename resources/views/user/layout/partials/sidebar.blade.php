<div class="col-md-2 col-sm-12 dashboard-sidebar">
    <div class="mr-1 shadow-lg">
        <div class="px-2 py-3 bg-purple-300 d-flex align-items-center">
            <div class="mx-2 sidebar-user-img-div">
                <img class="sidebar-user-img"
                    src="{{asset(!empty(auth()->user()->customer) && !empty(auth()->user()->customer->image) ? auth()->user()->customer->image : 'images/user.png')}}"
                    alt="" />
                <div class="green-dot"></div>
            </div>
            <div class="ml-2 text-white text-rtl">
                <p class="m-0 text-17 font-weight-bold">Welcome Back!</p>
                <p class="m-0 text-17">{{auth()->user()->name}}</p>
            </div>
        </div>
        <div>
            <ul class="sidebar-list">
                <li class="sidebar-list-item">
                    <a class="sidebar-link {{active('customer.dashboard')}}" href="{{route('customer.dashboard')}}">
                        <span class="sidebar-icon">
                            <i class="icon-dashboard"></i>
                        </span>
                        <span class="sidebar-link-name"> Dashboard </span>
                        <span class="ml-auto nav-rtl icon-right">
                            <i class="fas fa-arrow-circle-down"></i>
                        </span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a class="sidebar-link {{active('customer.my-profile.show')}}"
                        href="{{route('customer.my-profile.show')}}">
                        <span class="sidebar-icon">
                            <i class="icon-user"></i>
                        </span>
                        <span class="sidebar-link-name"> Profile </span>
                        <span class="ml-auto nav-rtl icon-right">
                            <i class="icon-chevron-right"></i>
                        </span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a class="sidebar-link" href="javascript:void(0);" onclick="sidebarLinkToggle(this);">
                        <span class="sidebar-icon">
                            <i class="icon-dashboard"></i>
                        </span>
                        <span class="sidebar-link-name"> Trip </span>
                        <span
                            class="ml-auto nav-rtl icon-right {{active('customer.make-trip.current-trip', 'icon-down')}}{{active('customer.make-trip.history-trip', 'icon-down')}}">
                            <i class="icon-chevron-right"></i>
                        </span>
                    </a>
                    <ul
                        class="sidebar-list d-none {{active('customer.make-trip.current-trip', 'd-block')}}{{active('customer.make-trip.history-trip', 'd-block')}}">
                        <li class="sidebar-list-item">
                            <a class="sidebar-link {{active('customer.make-trip.current-trip')}}"
                                href="{{route('customer.make-trip.current-trip')}}">
                                <span class="sidebar-icon">
                                    <i class="icon-bolt"></i>
                                </span>
                                <span class="sidebar-link-name"> Current Trip </span>
                                <span class="ml-auto nav-rtl icon-right">
                                    <i class="icon-chevron-right"></i>
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-list-item">
                            <a class="sidebar-link {{active('customer.make-trip.history-trip')}}"
                                href="{{route('customer.make-trip.history-trip')}}">
                                <span class="sidebar-icon">
                                    <i class="icon-calendar"></i>
                                </span>
                                <span class="sidebar-link-name"> Trip History </span>
                                <span class="ml-auto nav-rtl icon-right">
                                    <i class="icon-chevron-right"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-list-item">
                    <a class="sidebar-link" href="{{route('customer.change-password.show')}}">
                        <span class="sidebar-icon">
                            <i class="icon-key"></i>
                        </span>
                        <span class="sidebar-link-name"> Change Password </span>
                        <span class="ml-auto nav-rtl icon-right">
                            <i class="icon-chevron-right"></i>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>