<?php

namespace Modules\ArSys\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class ConfigController extends Controller
{
    public function home(){
        $user = Auth::user();
        if($user != null && $user->hasRole('admin'))
            return view ('arsys::livewire.config.admin.home-idx');
        else
            return redirect()->route('arsys');
    }

    public function space_Admin(){
        $user = Auth::user();
        if($user != null && $user->hasRole('admin')){
            return view ('arsys::livewire.config.admin.space.home-idx');
        }
        else
            return redirect()->route('arsys');
    }
}
