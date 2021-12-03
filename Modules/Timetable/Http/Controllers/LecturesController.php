<?php

namespace Modules\Timetable\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;

class LecturesController extends Controller
{
    public function presence_Faculty(){
        $user = Auth::user();
        if ($user != null && $user->hasRole('faculty')){
            return view ('timetable::livewire.presence.home-idx');
        }else{
            return redirect()->route('arsys');
        }
    }

    public function presenceRecap_Faculty($id){
        $user = Auth::user();
        if ($user != null && $user->hasRole('faculty')){
            return view ('timetable::livewire.presence.recap-idx', ['id' => $id]);
        }else{
            return redirect()->route('arsys');
        }
    }

    public function lectureSchedule_Faculty(){
        $user = Auth::user();
        if ($user != null && $user->hasRole('faculty')){
            return view ('timetable::livewire.schedule.faculty.lecture-idx');
        }else{
            return redirect()->route('arsys');
        }
    }

    public function lectureSchedule_Student(){
        $user = Auth::user();
        if ($user != null && $user->hasRole('student')){
            return view ('timetable::livewire.schedule.student.lecture-idx');
        }else{
            return redirect()->route('arsys');
        }
    }
}
