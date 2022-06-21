<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function  __construct(){
        $this->middleware('auth');
    }

    public function index(){
        DB::update("UPDATE notifications SET unread='1' WHERE received = :received",
            [
                'received' => Auth::user()->id,
            ]);

        $notifications = Notification::where('received','=',Auth::user()->id)->orderBy('created_at','DESC')->get();
        return view('notifications.index',compact('notifications'));
    }
    public function isRead(){
        DB::update("UPDATE notifications SET unread='1' WHERE received = :received",
            [
                'received' => Auth::user()->id,
            ]);
        return redirect()->back();
    }
}
