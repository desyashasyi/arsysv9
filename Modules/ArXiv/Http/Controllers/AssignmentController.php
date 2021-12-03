<?php

namespace Modules\ArXiv\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function preDefense_Assignment_Faculty(){
        $user = Auth::user();
        if($user != null && $user->hasRole('faculty'))
            return view ('arxiv::livewire.assignment.faculty.pre-defense-idx');
        else
            return redirect()->route('arsys');
    }

    public function seminar_Assignment_Faculty(){
        $user = Auth::user();
        if($user != null && $user->hasRole('faculty'))
            return view ('arxiv::livewire.assignment.faculty.seminar-idx');
        else
            return redirect()->route('arsys');
    }

    public function finalDefense_Assignment_Faculty(){
        $user = Auth::user();
        if($user != null && $user->hasRole('faculty'))
            return view ('arxiv::livewire.assignment.faculty.final-defense-idx');
        else
            return redirect()->route('arsys');
    }

    public function finalDefense_Assignment_Admin(){
        $user = Auth::user();
        if($user != null && $user->hasRole('admin'))
            return view ('arxiv::livewire.assignment.admin.final-defense-idx');
        else
            return redirect()->route('arsys');
    }


    public function finalDefenseAssignment_specialization(){
        $user = Auth::user();
        if($user != null && $user->hasRole('specialization'))
            return view ('arxiv::livewire.assignment.specialization.final-defense-idx');
        else
            return redirect()->route('arsys');
    }
}
