<?php

namespace Modules\ArSys\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Modules\ArSys\Entities\Event;

class EventController extends Controller
{
    public function admin(){
        $user = Auth::user();
        if($user != null && $user->hasRole('admin'))
            return view ('arsys::livewire.event.admin.home-idx');
        else
            return redirect()->route('arsys');
    }

    public function applicant_Admin($id){
        $user = Auth::user();
        if($user != null && $user->hasRole('admin'))
            return view ('arsys::livewire.event.admin.applicant-idx', compact('id'));
        else
            return redirect()->route('arsys');
    }

    /*public function student($id){
        $user = Auth::user();
        if($user != null && $user->hasRole('student')){
            $event = Event::where('id', $id)->first();
            return view ('arsys::event.student', compact('id', 'event'));
        }
        else
            return redirect()->route('arsys');
    }
    */

    public function user(){
        $user = Auth::user();
        if($user != null && ( $user->hasRole('student') || $user->hasRole('faculty') )){
            return view ('arsys::livewire.event.user.home-idx');
        }
        else
            return redirect()->route('arsys');
    }

    public function upcomingFaculty(){
        $user = Auth::user();
        if($user != null && $user->hasRole('faculty')){
            return view ('arsys::livewire.event.faculty.upcoming-idx');
        }
        else
            return redirect()->route('arsys');
    }

    public function presence_Admin($id){
        $user = Auth::user();
        if($user != null && $user->hasRole('admin')){
            return view ('arsys::livewire.event.admin.defense.presence-idx', compact('id'));
        }
        else
            return redirect()->route('arsys');
    }

    public function upcomingSeminar_ProgramLeader(){
        $user = Auth::user();
        if($user != null && $user->hasRole('program')){
            return view ('arsys::livewire.event.program.upcoming-seminar-idx');
        }
        else
            return redirect()->route('arsys');
    }

    public function space_Admin(){
        $user = Auth::user();
        if($user != null && $user->hasRole('admin')){
            return view ('arsys::livewire.event.admin.space-idx');
        }
        else
            return redirect()->route('arsys');
    }

}
