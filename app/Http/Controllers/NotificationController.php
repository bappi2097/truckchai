<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notification($locale, Notification $notification)
    {
        $url = $notification->url;
        $notification->delete();
        return redirect($url);
    }
}
