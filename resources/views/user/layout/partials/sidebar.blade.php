<div class="col-md-2 col-sm-12 dashboard-sidebar">
    <div class="mr-1 shadow-lg">
        <div class="px-2 py-3 bg-purple-300 d-flex align-items-center">
            <div class="mx-2 sidebar-user-img-div">
                <img class="sidebar-user-img" src="{{asset('images/user2-160x160.jpg')}}" alt="" />
                <div class="green-dot"></div>
            </div>
            <div class="ml-2 text-white text-rtl">
                <p class="m-0 text-17 font-weight-bold">Welcome Back!</p>
                <p class="m-0 text-17">John Doe</p>
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
                            <i class="icon-chevron-right"></i>
                        </span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a class="sidebar-link" href="{{route('customer.my-profile.show')}}">
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
                        <span class="ml-auto nav-rtl icon-right">
                            <i class="icon-chevron-right"></i>
                        </span>
                    </a>
                    <ul class="sidebar-list d-none">
                        <li class="sidebar-list-item">
                            <a class="sidebar-link" href="#">
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
                            <a class="sidebar-link" href="#">
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
                    <a class="sidebar-link" href="#">
                        <span class="sidebar-icon">
                            <i class="icon-book"></i>
                        </span>
                        <span class="sidebar-link-name"> Address Book </span>
                        <span class="ml-auto nav-rtl icon-right">
                            <i class="icon-chevron-right"></i>
                        </span>
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a class="sidebar-link" href="javascript:void(0);" onclick="sidebarLinkToggle(this);">
                        <span class="sidebar-icon">
                            <i class="icon-envelope"></i>
                        </span>
                        <span class="sidebar-link-name"> Inbox </span>
                        <span class="ml-auto nav-rtl icon-right">
                            <i class="icon-chevron-right"></i>
                        </span>
                    </a>
                    <ul class="sidebar-list d-none">
                        <li class="sidebar-list-item">
                            <a class="sidebar-link" href="#">
                                <span class="sidebar-icon">
                                    <i class="icon-bell-alt"></i>
                                </span>
                                <span class="sidebar-link-name"> Notification </span>
                                <span class="ml-auto nav-rtl icon-right">
                                    <i class="icon-chevron-right"></i>
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-list-item">
                            <a class="sidebar-link" href="#">
                                <span class="sidebar-icon">
                                    <i class="icon-dashboard"></i>
                                </span>
                                <span class="sidebar-link-name"> Campaign </span>
                                <span class="ml-auto nav-rtl icon-right">
                                    <i class="icon-chevron-right"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-list-item">
                    <a class="sidebar-link" href="#">
                        <span class="sidebar-icon">
                            <i class="icon-ticket"></i>
                        </span>
                        <span class="sidebar-link-name"> Cuppon </span>
                        <span class="ml-auto nav-rtl icon-right">
                            <i class="icon-chevron-right"></i>
                        </span>
                    </a>
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
                <li class="sidebar-list-item">
                    <a class="sidebar-link" href="#">
                        <span class="sidebar-icon">
                            <i class="icon-cog"></i>
                        </span>
                        <span class="sidebar-link-name"> Setting </span>
                        <span class="ml-auto nav-rtl icon-right">
                            <i class="icon-chevron-right"></i>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>