<?php

namespace Modules\ArSys\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class SuperviseController extends Controller
{
    public function faculty(){
        $user = Auth::user();
        if($user != null && $user->hasRole('faculty'))
            return view ('arsys::livewire.supervise.faculty.home-idx');
        else
            return redirect()->route('arsys');
    }
}
