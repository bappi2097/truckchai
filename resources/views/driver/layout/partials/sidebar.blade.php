<div class="col-md-2 col-sm-12 dashboard-sidebar">
    <div class="mr-1 shadow-lg">
        <div class="px-2 py-3 bg-purple-300 d-flex align-items-center">
            <div class="mx-2 sidebar-user-img-div">
                <img class="sidebar-user-img"
                    src="{{asset(auth()->user()->driver ? auth()->user()->driver->image : 'images/user.png')}}"
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
                    <a class="sidebar-link {{active('driver.dashboard')}}" href="{{route('driver.dashboard')}}">
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
                    <a class="sidebar-link {{active('driver.my-profile.show')}}"
                        href="{{route('driver.my-profile.show')}}">
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
                    <a class="sidebar-link {{active('driver.truck.show')}}" href="{{route('driver.truck.show')}}">
                        <span class="sidebar-icon">
                            <i class="icon-truck"></i>
                        </span>
                        <span class="sidebar-link-name"> Truck </span>
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
                            class="ml-auto nav-rtl icon-right {{active('driver.trip.current-trip', 'icon-down')}}{{active('driver.trip.history-trip', 'icon-down')}}">
                            <i class="icon-chevron-right"></i>
                        </span>
                    </a>
                    <ul
                        class="sidebar-list d-none {{active('driver.trip.current-trip', 'd-block')}}{{active('driver.trip.history-trip', 'd-block')}}">
                        <li class="sidebar-list-item">
                            <a class="sidebar-link {{active('driver.trip.current-trip')}}"
                                href="{{route('driver.trip.current-trip')}}">
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
                            <a class="sidebar-link {{active('driver.trip.history-trip')}}"
                                href="{{route('driver.trip.history-trip')}}">
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
                    <a class="sidebar-link" href="{{route('driver.change-password.show')}}">
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