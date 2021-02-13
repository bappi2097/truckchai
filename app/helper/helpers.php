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

function active($route)
{
    return request()->route()->getName() == $route ? 'active' : '';
}
function notification($alert_type, $message)
{
    $notification['alert-type'] = $alert_type;
    $notification['message'] = $message;
    return $notification;
}
