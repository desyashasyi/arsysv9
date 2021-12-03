<?php

namespace Modules\ArSys\Http\Livewire\Event\Faculty;

use Livewire\Component;
use Modules\ArSys\Entities\Event;
use Modules\ArSys\Entities\SeminarRoom;
use Modules\ArSys\Entities\SeminarExaminer;
use Modules\ArSys\Entities\SeminarExaminerScore;
use Modules\ArSys\Entities\SeminarExaminerPresence;
use Carbon\Carbon;

class UpcomingSeminar extends Component
{
    protected $listners=['refreshUpcomingEventSeminarComponent' => 'refreshUpcoming',
                        ];
    public $eventId;
    public $currentRoom = null;
    public function render()
    {
        $events = Event::where('status', 1)->where('event_date', '>=', Carbon::today())
        ->where('status', null)
        ->get();
        return view('arsys::livewire.event.faculty.upcoming-seminar', compact('events'));
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
    public function refreshUpcoming(){
        dd('here');
        $this->emit('refreshUpcomingEventComponent');
    }

}
