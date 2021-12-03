<?php

namespace Modules\Timetable\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Auth;
class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index_Planner()
    {
        return view('timetable::schedule.planner');
    }

    public function curriculumImport_Planner(){
        return view ('timetable::curriculum.planner');
    }


    public function curriculumImport_Clerk(){
        $user = Auth::user();

        if($user->hasRole('clerk')){
           return view('timetable::livewire.curriculum.clerk.home-idx');
        }else{
            return redirect()->route('arsys.home');
        }
    }

    public function subjectHome_Admin(){
        $user = Auth::user();

        if($user->hasRole('admin')){
           return view('timetable::livewire.subject.admin.home-idx');
        }else{
            return redirect()->route('arsys.home');
        }
    }
    public function scheduleHome_Admin(){
        $user = Auth::user();

        if($user->hasRole('admin')){
           return view('timetable::livewire.schedule.admin.home-idx');
        }else{
            return redirect()->route('arsys.home');
        }
    }


    public function fetHome_Admin(){
        $user = Auth::user();

        if($user->hasRole('admin')){
           return view('timetable::livewire.fet.admin.home-idx');
        }else{
            return redirect()->route('arsys.home');
        }
    }
}
