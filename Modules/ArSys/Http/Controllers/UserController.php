<?php

namespace Modules\ArSys\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
class UserController extends Controller
{
    public function userManagement_Admin(){
        $user = Auth::user();
        if($user != null && $user->hasRole('admin')){
            return view ('arsys::livewire.user.admin.home-idx');
        }else
            return redirect()->route('arsys');
    }

    public function refreshLogin_User(){
        //$request->session()->flush();
        \Session::flush();
        return redirect('/');
    }

    public function mobileActivation_User(){
        $user = Auth::user();
        if($user != null && ($user->hasRole('faculty') || $user->hasRole('student'))){
            return view ('arsys::livewire.user.mobile-activation-idx');
        }else
            return redirect()->route('arsys');
    }
}
