<?php

namespace Modules\ArSys\Http\Livewire\Event\Student;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\ArSys\Entities\EventApplicant;
use Modules\ArSys\Entities\Event;

class Applicant extends Component
{

    public $eventId;
    public $showApplicant =false;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners =['emiterStudentEventApplicant' => 'eventApplicant'];

    public function render()
    {
        $applicants = null;
        $event = null;
        if($this->showApplicant == true){
            $applicants = EventApplicant::where('event_id', $this->eventId)
                    ->paginate(2);
            $event = Event::where('id', $this->eventId)->first();
        }

        return view('arsys::livewire.event.student.applicant',compact('applicants', 'event'));
    }

    public function eventApplicant($id){
        $this->showApplicant = true;
        $this->eventId = $id;
        $this->emit('studentEventApplicantModal');
    }
}
