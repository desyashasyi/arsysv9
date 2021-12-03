<?php

namespace Modules\Office\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Auth;

class LetterSubmissionController extends Controller
{
    public function proposalSeminar_Clerk(){
        $user = Auth::user();
        if($user != null && $user->hasRole('clerk')){
            return view ('office::livewire.letter.clerk.proposal-seminar-idx');
        }else
            return redirect()->route('arsys');
    }
}
