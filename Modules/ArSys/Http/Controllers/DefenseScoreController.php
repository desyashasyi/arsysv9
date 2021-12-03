<?php

namespace Modules\ArSys\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class DefenseScoreController extends Controller
{
    public function defenseScore_ProgramLeader(){
        $user = Auth::user();
    if($user != null && $user->hasRole('faculty'))
        return view ('arsys::score.program-leader.defense-score');
    else
        return redirect()->route('arsys');
    }

}
