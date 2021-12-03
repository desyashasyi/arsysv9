<?php

namespace Modules\ArXiv\Http\Livewire\Assignment\Faculty;

use Livewire\Component;
use Modules\ArSys\Entities\Event;
use Livewire\WithPagination;
use Auth;

class FinalDefense extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $events = Event::where('status', 1)->where('event_type', \Modules\ArSys\Entities\EventType::where('abbrev', 'PUB')->first()->id)
            ->orderBy('event_date', 'DESC')->paginate(10);
        return view('arxiv::livewire.assignment.faculty.final-defense', compact('events'));
    }
    public function printAssignment($applicant_id){
        return redirect()->route('arsys.print.faculty.assignment.pre-defense', $applicant_id);
    }
    
}
