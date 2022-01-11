<?php

namespace Modules\ArSys\Http\Livewire\Event\Admin;

use Livewire\Component;
use Modules\ArSys\Entities\Event;
use Modules\ArSys\Entities\EventApplicant;
use Modules\ArSys\Entities\EventType;
use Livewire\WithPagination;

use Modules\ArSys\Entities\ResearchMilestone;
use \Carbon\Carbon;

class ChangeApplicant extends Component
{
    public $applicantId;
    public $applicant;
    public $milestone;
    public $defenseType;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'eventChangeScheduleComponent' => 'changeApplicant',
    ];
    public function render()
    {

        $this->applicant = EventApplicant::where('id', $this->applicantId)->first();
        if($this->applicant != null){

            $this->milestone = ResearchMilestone::where('sequence', $this->applicant->research->research_milestone)->first();
            //dd($this->applicant, $this->milestone);
        }

        $events = null;
        if($this->milestone != null){
            $events = Event::where('event_type', EventType::where('defense_model', $this->defenseType)->first()->id)
                ->where('event_date', '>', Carbon::today())
                ->where('id', '!=', $this->applicant->event_id)
                ->orderBy('application_deadline', 'ASC')
                ->paginate(5);

                //->get();
                //dd($this->applicant, $this->milestone, $events);
        }
        return view('arsys::livewire.event.admin.change-applicant', compact('events'));
    }

    public function changeApplicant($applicant_id, $type){
        $this->applicantId = $applicant_id;
        $this->emit('changeApplicantModal');
        $this->defenseType = $type;
    }


    public function change($event_id){
        EventApplicant::find($this->applicant->id)->update([
            'event_id' => $event_id,
        ]);
        Event::find($this->applicant->event->id)->decrement('current');
        Event::find($event_id)->increment('current');
        $this->emit('refreshAdminEventApplicant');
    }
}
