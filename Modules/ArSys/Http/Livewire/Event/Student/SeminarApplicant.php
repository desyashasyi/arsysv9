<?php

namespace Modules\ArSys\Http\Livewire\Event\Student;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\ArSys\Entities\EventApplicant;
use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\Event;
use Modules\ArSys\Entities\SeminarRoom;
class SeminarApplicant extends Component
{

    public $eventId;
    public $researchId;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['eventSeminarApplicantComponent_Student' => 'seminarApplicant'];
    public function render()
    {
        $event = Event::where('id', $this->eventId)->first();
        return view('arsys::livewire.event.student.seminar-applicant',compact('event'));
    }

    public function seminarApplicant($event_id, $research_id){
        $this->researchId = $research_id;
        $this->eventId = $event_id;
        $this->emit('eventSeminarApplicantModal_Student');
    }
}
