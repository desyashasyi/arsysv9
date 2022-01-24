<?php

namespace Modules\ArSys\Http\Livewire\Event\Faculty;

use Livewire\Component;
use Modules\ArSys\Entities\Event;
use \carbon\Carbon;
use Livewire\WithPagination;

use Modules\ArSys\Entities\SeminarRoom;
use Modules\ArSys\Entities\SeminarExaminer;
use Modules\ArSys\Entities\SeminarExaminerScore;
use Modules\ArSys\Entities\SeminarExaminerPresence;
use Modules\ArSys\Entities\EventApplicant;
use Modules\ArSys\Entities\DefenseExaminer;
use Modules\ArSys\Entities\DefenseExaminerPresence;
use Modules\ArSys\Entities\ResearchMilestone;

class Upcoming extends Component
{
    protected $listners=['refreshUpcomingEventComponent' => '$refresh',
        'refreshTestUpcomingEventComponent' => 'testRefresh',
        'wirePollEnableUpcomingEventSeminarComponent'=> 'wirePollEnable'];
    //public $eventId;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $events = Event::where('status', 1)->where('event_date', '>=', Carbon::today()->subDay(3))
        ->orderBy('event_date', 'ASC')
        ->paginate(1);
        return view('arsys::livewire.event.faculty.upcoming', compact('events'));
    }
    public function wirePollEnable(){
        dd('here');
    }

    public function examinerPresence($examiner_id){
        $examiner = SeminarExaminer::where('id', $examiner_id)->first();
        $room = SeminarRoom::where('id', $examiner->room_id)->first();
        $presence = SeminarExaminerPresence::where('examiner_id', $examiner_id)->where('event_id', $room->event_id)
            ->where('room_id', $room->id)->first();

        if($presence == null){
            SeminarExaminerPresence::create([
                'examiner_id' => $examiner_id,
                'room_id' => $room->id,
                'event_id' => $room->event_id,
            ]);
            foreach($room->applicant as $applicant){
                SeminarExaminerScore::create([
                    'applicant_id' => $applicant->id,
                    'event_id' => $room->event_id,
                    'examiner_id' => $examiner_id,
                ]);
            }
        }else{
            SeminarExaminerPresence::where('examiner_id', $examiner_id)->where('event_id', $room->event_id)
                    ->where('room_id', $room->id)->delete();
            foreach($room->applicant as $applicant){
                SeminarExaminerScore::where('applicant_id', $applicant->id)
                    ->where('event_id', $room->event_id)->where('examiner_id',$examiner_id)->delete();
            }
        }


    }
    public function printAssignment($room_id, $event_id){
        return redirect()->route('arsys.print.faculty.assignment.final-defense', $room_id);
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

    public function preDefensePrintAssignment($applicant_id){
        return redirect()->route('arsys.print.faculty.assignment.pre-defense', $applicant_id);
    }
    public function refreshUpcoming(){
        $this->emit('refreshUpcomingEventComponent');
    }

    public function testRefresh(){
        dd('here');
    }
}
