<?php

namespace Modules\ArXiv\Http\Livewire\Assignment\Faculty;

use Livewire\Component;

use Modules\ArXiv\Entities\ResearchSupervisor;
use Auth;
class Supervision extends Component
{
    public function render()
    {
        $supervises = ResearchSupervisor::where('supervisor_id', Auth::user()->faculty->id)->get();
        return view('arxiv::livewire.assignment.faculty.supervision', compact('supervises'));
    }
}
