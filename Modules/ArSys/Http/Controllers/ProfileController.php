<?php

namespace Modules\ArSys\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class ProfileController extends Controller
{
    public function student(){
        $user = Auth::user();
        if($user != null && $user->hasRole('student')){
            return view ('arsys::livewire.profile.student.home-idx');
        }
        else
            return redirect()->route('arsys');
    }



    public function facultyDuty_Admin(){
        $user = Auth::user();
        if($user != null && $user->hasRole('admin')){
            return view ('arsys::livewire.profile.admin.faculty-duty-idx');
        }
        else
            return redirect()->route('arsys');
    }
}
