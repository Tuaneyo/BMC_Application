<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
        public function get()
        {
            $notes = [];
            $notifications = Auth::user()->notifications()->get();
            $notes[0] = $notifications;
            $notes[1] = count(Auth::user()->unreadNotifications()->get());
            return $notes;
            //return Notification::all();
        }

        public function read(Request $request)
        {
                Auth::user()->notifications()->find($request->id)->MarkAsRead();
                return 'success';
        }
}
