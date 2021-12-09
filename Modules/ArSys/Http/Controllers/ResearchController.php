<?php

namespace Modules\ArSys\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Modules\ArSys\Entities\Student;

class ResearchController extends Controller
{
    public function student(){
        $user = Auth::user();

        if($user != null && $user->hasRole('student')){
            $profile = Student::where('code', $user->name)->first();


            if($profile == null){
               return redirect()->route('arsys.profile.student');
            }else{
                return view ('arsys::livewire.research.student.home-idx');
            }
        }else
            return redirect()->route('arsys');
    }


    public function create_Student(){
        $user = Auth::user();

        if ($user != null && $user->hasRole('student')){

            $student = Student::where('user_id', $user->id)->first();
            return view ('arsys::research.student.create', compact('student'));
        }else
            return redirect()->route('arsys');
    }

    public function inProgress_Specialization(){
        $user = Auth::user();
        if ($user != null && $user->hasRole('specialization')){
            return view ('arsys::livewire.research.specialization.progress-idx');
        }else
            return redirect()->route('arsys');
    }

    public function expired_Specialization(){
        $user = Auth::user();
        if ($user != null && $user->hasRole('specialization')){
            return view ('arsys::livewire.research.specialization.expired-idx');
        }else
            return redirect()->route('arsys');
    }

    public function completed_Specialization(){
        $user = Auth::user();
        if ($user != null && $user->hasRole('faculty')){
            return view ('arsys::livewire.research.specialization.completed-idx');
        }else
            return redirect()->route('arsys');
    }


    public function monitoring_Admin(){
        $user = Auth::user();
        if ($user != null && $user->hasRole('admin')){
            return view ('arsys::livewire.research.admin.home-idx');
        }else
            return redirect()->route('arsys');
    }

    public function dashboard_Clerk(){
        $user = Auth::user();
        if ($user != null && $user->hasRole('clerk')){
            return view ('arsys::livewire.research.clerk.dashboard');
        }else
            return redirect()->route('arsys');
    }
}
