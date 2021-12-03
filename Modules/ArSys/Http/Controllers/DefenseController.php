<?php

namespace Modules\ArSys\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;

class DefenseController extends Controller
{
    public function preDefense_ProgramLeader(){
        $user = Auth::user();
        if($user != null && $user->hasRole('program'))
            return view ('arsys::livewire.defense.program.pre-idx');
        else
            return redirect()->route('arsys');
    }

    public function defenseApproval_ProgramLeader(){
        $user = Auth::user();
        if($user != null && $user->hasRole('program'))
            return view ('arsys::livewire.defense.program.approval-idx');
        else
            return redirect()->route('arsys');
    }

    public function seminarMark_ProgramLeader(){
        $user = Auth::user();
        if($user != null && $user->hasRole('program'))
            return view ('arsys::livewire.seminar.program.seminar-mark-idx');
        else
            return redirect()->route('arsys');
    }

    public function preDefenseAll_ProgramLeader(){
        $user = Auth::user();
        if($user != null && $user->hasRole('program'))
            return view ('arsys::livewire.defense.program.pre-defense-all-idx');
        else
            return redirect()->route('arsys');
    }
}
