<?php

namespace Modules\ArXiv\Http\Livewire\Assignment\Faculty;
use Livewire\Component;
use Modules\ArSys\Entities\Event;
use Livewire\WithPagination;
use Auth;

class Seminar extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $events = Event::where('status', 1)->where('event_type', \Modules\ArSys\Entities\EventType::where('defense_model', 'Seminar')->first()->id)
        ->whereHas('room', function($query) {
            $query->whereHas('examiner', function($query) {
                $query->where('examiner_id', Auth::user()->faculty->id);
            });
        })
        ->get();
        return view('arxiv::livewire.assignment.faculty.seminar', compact('events'));
    }
    public function printAssignment($applicant_id){
        return redirect()->route('arsys.print.faculty.assignment.pre-defense', $applicant_id);
    }
    
}
