<div id="sidebar" class="sidebar">
    <div data-scrollbar="true" data-height="100%">
        <ul class="nav">
            <li class="nav-profile">
                <a href="javascript:;" data-toggle="nav-profile">
                    <div class="cover with-shadow"></div>
                    <div class="image">
                        <img src="{{asset('assets/img/user/user-13.jpg')}}" alt="" />
                    </div>
                    <div class="info">
                        <b class="caret pull-right"></b>Sean Ngu
                        <small>Front end developer</small>
                    </div>
                </a>
            </li>
            <li>
                <ul class="nav nav-profile">
                    <li>
                        <a href="javascript:;"><i class="fa fa-cog"></i> Settings</a>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="fa fa-pencil-alt"></i> Send Feedback</a>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="fa fa-question-circle"></i> Helps</a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="nav">
            <li class="nav-header">Navigation</li>
            <li class="has-sub {{active('admin.dashboard')}}">
                <a href="{{route('admin.dashboard')}}">
                    <i class="fa fa-th-large"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-header">User Category</li>
            <li class="has-sub">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="fa fa-th-large"></i>
                    <span>Users</span>
                </a>
                <ul class="sub-menu">
                    <li class="">
                        <a href="">Admin</a>
                    </li>
                    <li class="">
                        <a href="">Customer</a>
                    </li>
                    <li class="">
                        <a href="">Company</a>
                    </li>

                </ul>
            </li>
            <li class="nav-header">Truck Category</li>
            <li class="has-sub {{set_active('admin/truck-size-category*')}}">
                <a href="javascript:;">
                    <b class="caret"></b>
                    <i class="fa fa-th-large"></i>
                    <span>Truck Category</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{active('admin.truck-size-category.index')}}">
                        <a href="{{route('admin.truck-size-category.index')}}">Category List</a>
                    </li>
                    <li class="{{active('admin.truck-size-category.index')}}">
                        <a href="{{route('admin.truck-size-category.index')}}">Truck Size</a>
                    </li>
                </ul>
            </li>
            <li class="{{active('admin.language.index')}}">
                <a href="{{route('admin.language.index')}}">
                    <i class="fa fa-th-large"></i>
                    <span>Languages</span>
                </a>
            </li>
            <li class="has-sub">
                <a href="javascript:;">
                    <span class="badge pull-right">10</span>
                    <i class="fa fa-hdd"></i>
                    <span>Email</span>
                </a>
            </li>
            <li>
                <a href="widget.html">
                    <i class="fab fa-simplybuilt"></i>
                    <span>Widgets <span class="label label-theme">NEW</span></span>
                </a>
            </li>
            <li>
                <a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i
                        class="fa fa-angle-double-left"></i></a>
            </li>
        </ul>
    </div>
</div>