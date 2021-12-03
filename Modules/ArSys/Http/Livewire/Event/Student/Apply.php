<?php

namespace Modules\ArSys\Http\Livewire\Event\Student;

use Livewire\Component;
use Modules\ArSys\Entities\Event;
use Modules\ArSys\Entities\EventApplicant;
use Modules\ArSys\Entities\EventType;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\ResearchType;
use Livewire\WithPagination;

use Modules\ArSys\Entities\ResearchMilestone;
use Modules\ArSys\Entities\ResearchMilestoneSeminar;
use \Carbon\Carbon;
class Apply extends Component
{
    public $research;
    use WithPagination;
    public $milestone;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['studentEventApplyComponent' => 'applyEvent'];
    public function render()
    {
        $events = null;
        if($this->research != null){
            if($this->research->research_type == ResearchType::where('code', 'SE')->first()->id){
                $milestone = ResearchMilestoneSeminar::where('sequence', $this->milestone)->first();
                $events = Event::where('event_type', EventType::where('defense_model', 'Seminar')->first()->id)
                        ->where('application_deadline', '>', Carbon::now())
                        ->orderBy('application_deadline', 'ASC')
                        ->paginate(2);
            }elseif($this->research->research_type == (ResearchType::where('code', 'SK')->first()->id || $this->research->research_type == ResearchType::where('code', 'TA')->first()->id)){
                $milestone = ResearchMilestone::where('sequence', $this->milestone)->first();
                $events = Event::where('event_type', EventType::where('defense_model', $milestone->milestone)->first()->id)
                        ->where('application_deadline', '>', Carbon::now())
                        ->orderBy('application_deadline', 'ASC')
                        ->paginate(2);
            }
        }

        return view('arsys::livewire.event.student.apply', compact('events'));
    }

    public function applyEvent($id, $milestone){

        $this->milestone = $milestone;
        $this->research = Research::where('id', $id)->first();
        $this->emit('studentEventApplyModal');
    }

    public function submitApplication($event_id,  $research_id){
        $eventDeadlineCheck = Event::where('id', $event_id)->first();
        if($eventDeadlineCheck->application_deadline >= Carbon::now()){
            $event = EventApplicant::where('research_id', $research_id)
            ->where('event_id', $event_id)->first();

            if($event == null){
                Research::find($research_id)->increment('research_milestone');
                EventApplicant::create([
                    'event_id' => $event_id,
                    'research_id' => $research_id,
                ]);
                Event::find($event_id)->increment('current');
            }
        }
        $this->emit('refreshStudentResearchPage');
    }
}
