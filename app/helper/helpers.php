<?php
function htmlLangDir()
{
    $lang = app()->getLocale();
    $dir = $lang == "ar" ? "rtl" : "auto";
    return "lang=$lang dir=$dir";
}

function isPageRTL()
{
    return app()->getLocale() == "ar" ? true : false;
}

function active($route, $text = "active")
{
    return request()->route()->getName() == $route ? $text : '';
}

function set_active($path, $active = 'active')
{
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}

function notification($alert_type, $message)
{
    $notification['alert-type'] = $alert_type;
    $notification['message'] = $message;
    return $notification;
}

function dashboardURL()
{
    if (auth()->check()) {
        if (auth()->user()->hasRole('customer')) {
            return route('customer.dashboard');
        } else if (auth()->user()->hasRole('company')) {
            return route('company.dashboard');
        } else if (auth()->user()->hasRole('driver')) {
            return route('driver.dashboard');
        } else if (auth()->user()->hasRole('admin')) {
            return route('admin.dashboard');
        } else {
            return route('home');
        }
    }
}

function selected($data1, $data2)
{
    if (!is_array($data2)) {
        return $data1 == $data2 ? 'selected' : '';
    } else {
        return in_array($data1, $data2) ? 'selected' : '';
    }
}

function tripStatus($no)
{
    switch ($no) {
        case 0:
            return ["Bidding", "dark"];
        case 1:
            return ["Running", "primary"];
        case 2:
            return ["Cancelled", "danger"];
        case 3:
            return ["Finished", "danger"];
    }
}
function truckValid($status)
{
    switch ($status) {
        case 0:
            return ["Not Valid Yet", "warning"];
        case 1:
            return ["Valid", "success"];
        case 2:
            return ["Rejected", "danger"];
    }
}
