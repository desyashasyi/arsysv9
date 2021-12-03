<?php

namespace Modules\ArXiv\Http\Livewire\Assignment\Faculty;

use Livewire\Component;
use Auth;

class LectureIdx extends Component
{
    public function render()
    {
        return view('arxiv::livewire.assignment.faculty.lecture-idx')->layout('adminlte::page');
    }
    public function mount(){
        $user = Auth::user();
        if($user == null || !$user->hasRole('faculty')){
            return redirect()->route('arsys');
        }
    }

}
