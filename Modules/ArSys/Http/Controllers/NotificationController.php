<?php

namespace Modules\ArSys\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class NotificationController extends Controller
{
    public function notification_Admin(){
        $user = Auth::user();
        if($user != null && $user->hasRole('admin'))
            return view ('arsys::notification.admin.index');
        else
            return redirect()->route('arsys');
    }
}
