<?php

namespace Modules\ArSys\Http\Livewire\Event\Faculty;

use Livewire\Component;
use Modules\ArSys\Entities\Event;
use Modules\ArSys\Entities\EventApplicant;
use Modules\ArSys\Entities\DefenseExaminer;
use Modules\ArSys\Entities\DefenseExaminerPresence;
use Modules\ArSys\Entities\ResearchMilestone;
use \Carbon\Carbon;

class UpcomingDefense extends Component
{
    protected $listners=['refreshUpcomingEventDefenseComponent' => 'refreshUpcoming'];
    public function render()
    {
        $events = Event::where('status', 1)->where('event_date', '>=', Carbon::today()->subDays(7))
                ->orderBy('event_date', 'DESC')
               ->get();

        return view('arsys::livewire.event.faculty.upcoming-defense', compact('events'));
    }

    public function setPresence($id){
        $examiner = DefenseExaminer::where('id', $id)->first();
        $applicant = EventApplicant::where('id', $examiner->applicant_id)->first();
        $presence = DefenseExaminerPresence::where('applicant_id', $examiner->applicant_id)
            ->where('event_id', $examiner->event_id)
            ->where('examiner_id', $examiner->id)->first();

        if($presence == null){
            if(DefenseExaminerPresence::where('applicant_id', $examiner->applicant_id)
            ->where('event_id', $examiner->event_id)->count() < 3){
                DefenseExaminerPresence::create([
                    'applicant_id' => $examiner->applicant_id,
                    'event_id' => $examiner->event_id,
                    'examiner_id' => $examiner->id,
                ]);
                //$this->emit('successMessage', 'The examiner presence has been submitted' );
            }

        }else{
            $this->emit('removeExaminerPresence', $presence->id);
        }

        if($applicant->research->research_milestone ==
            ResearchMilestone::where('milestone', 'Pre-defense')
                ->where('phase', 'Scheduled')->first()->sequence){
                    $applicant->research->increment('research_milestone');
                }

    }

    public function removePresence($presence_id){
        DefenseExaminerPresence::find($presence_id)->delete();
    }

    public function printAssignment($applicant_id){
        return redirect()->route('arsys.print.faculty.assignment.pre-defense', $applicant_id);
    }
    public function refreshUpcoming(){
        $this->emit('refreshUpcomingEventComponent');
    }
}
