<?php

namespace Modules\ArSys\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;

class DocumentController extends Controller
{
    public function applicationLetter_Clerk(){
        $user = Auth::user();
        if($user != null && $user->hasRole('clerk'))
            return view ('arsys::livewire.document.clerk.application-letter-idx');
        else
            return redirect()->route('arsys');
    }
}
