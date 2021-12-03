<?php

namespace Modules\ArSys\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class ReviewController extends Controller
{

    public function newProposal_Specialization(){

        $user = Auth::user();
        if($user != null && $user->hasRole('specialization'))
        return view ('arsys::livewire.review.specialization.proposal.home-idx');
        else
            return redirect()->route('arsys');

    }

    public function reviseProposal_Specialization(){

        $user = Auth::user();
        if($user != null && $user->hasRole('specialization'))
        return view ('arsys::livewire.review.specialization.proposal.revise-idx');
        else
            return redirect()->route('arsys');

    }

    public function presentationProposal_Specialization(){

        $user = Auth::user();
        if($user != null && $user->hasRole('specialization'))
        return view ('arsys::livewire.review.specialization.proposal.presentation-idx');
        else
            return redirect()->route('arsys');

    }

    public function proposal_Faculty(){

        $user = Auth::user();
        if($user != null && $user->hasRole('faculty'))
        return view ('arsys::livewire.review.faculty.home-idx');
        else
            return redirect()->route('arsys');

    }

    public function newProposal_Coordinator(){

        $user = Auth::user();
        if($user != null && $user->hasRole('coordinator'))
        return view ('arsys::livewire.review.coordinator.home-idx');
        else
            return redirect()->route('arsys');

    }
}
