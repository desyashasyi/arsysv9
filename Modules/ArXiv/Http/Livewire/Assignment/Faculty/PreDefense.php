<?php

namespace Modules\ArXiv\Http\Livewire\Assignment\Faculty;

use Livewire\Component;
use Modules\ArSys\Entities\Event;
use Livewire\WithPagination;
use Auth;

class PreDefense extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $events = Event::where('status', 1)->where('event_type', \Modules\ArSys\Entities\EventType::where('defense_model', 'Pre-defense')->first()->id)
        ->whereHas('applicant', function($query) {
            $query->whereHas('supervisor', function($query) {
                $query->where('supervisor_id', Auth::user()->faculty->id);
            })
            ->orWhereHas('examiner', function($query) {
                $query->where('examiner_id', Auth::user()->faculty->id);
            });
        })
        ->paginate(10);
        return view('arxiv::livewire.assignment.faculty.pre-defense', compact('events'));
    }
    public function printAssignment($applicant_id){
        return redirect()->route('arsys.print.faculty.assignment.pre-defense', $applicant_id);
    }
    
}
