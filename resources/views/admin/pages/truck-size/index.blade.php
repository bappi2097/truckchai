@extends('admin.layout.app')
@section('content')
<a href="{{route('admin.truck-size-category.create')}}" class="btn btn-primary">Add Data</a>
<div class="col-12">
    <div class="table-responsive">
        <table class="table table-striped m-b-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email Address</th>
                    <th width="1%"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="with-img">
                        <img src="../assets/img/user/user-1.jpg" class="img-rounded height-30">
                    </td>
                    <td>Nicky Almera</td>
                    <td>nicky@hotmail.com</td>
                    <td class="with-btn" nowrap="">
                        <a href="#" class="btn btn-sm btn-primary width-60 m-r-2">Edit</a>
                        <a href="#" class="btn btn-sm btn-white width-60">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td class="with-img">
                        <img src="../assets/img/user/user-2.jpg" class="img-rounded height-30">
                    </td>
                    <td>Edmund Wong</td>
                    <td>edmund@yahoo.com</td>
                    <td class="with-btn-group" nowrap="">
                        <div class="btn-group">
                            <a href="#" class="btn btn-white btn-sm width-90">Settings</a>
                            <a href="#" class="btn btn-white btn-sm dropdown-toggle width-30 no-caret"
                                data-toggle="dropdown">
                                <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="#" class="dropdown-item">Action 1</a>
                                <a href="#" class="dropdown-item">Action 2</a>
                                <a href="#" class="dropdown-item">Action 3</a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">Action 4</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="with-img">
                        <img src="../assets/img/user/user-3.jpg" class="img-rounded height-30">
                    </td>
                    <td>Harvinder Singh</td>
                    <td>harvinder@gmail.com</td>
                    <td class="with-btn" nowrap="">
                        <a href="#" class="btn btn-sm btn-primary width-60 m-r-2">Edit</a>
                        <a href="#" class="btn btn-sm btn-white width-60">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection