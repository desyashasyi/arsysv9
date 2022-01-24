<?php

namespace Modules\ArSys\Http\Livewire\Event\Admin\Seminar;

use Livewire\Component;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\EventApplicantWaiting;
use Modules\ArSys\Entities\EventType;

class ApplicantWaiting extends Component
{
    public $searchStudent = null;
    public $eventId;
    public function render()
    {
        $researchs = null;
        if($this->searchStudent){
            $researchs = Research::whereHas('student', function($query){
                $query->where('first_name', 'like', '%' . $this->searchStudent . '%');
            })
            ->where('research_milestone','>=', 10)
            ->where('research_milestone','<=', 12)
            ->paginate(5);
        }

        return view('arsys::livewire.event.admin.seminar.applicant-waiting', compact('researchs'));
    }
    public function mount($event_id){
        $this->eventId = $event_id;
    }
    public function addResearch($research_id){
       $waitingApplicant = EventApplicantWaiting::where('research_id', $research_id)
            ->where('event_id', $this->eventId)->first();
        if($waitingApplicant == null){
            EventApplicantWaiting::create([
                'research_id' => $research_id,
                'event_id' => $this->eventId,
                'event_type' => EventType::where('abbrev', 'PUB')->first()->id,
            ]);
        }
        $this->searchStudent = null;
        $this->emit('refreshSeminarApplicant');
    }
}
