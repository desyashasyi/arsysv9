<?php

namespace Modules\ArSys\Http\Livewire\Event\Admin\Seminar;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\SeminarRoom;
use Modules\ArSys\Entities\SeminarModerator;
use Modules\ArSys\Entities\EventApplicant;

class AddModerator extends Component
{
    public $eventId;
    public $roomId;
    public $searchModerator;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['seminarModeratorComponent' => 'seminarModerator'];
    public function render()
    {
        $room = null;
        $faculties = null;
        $applicants = null;
        if($this->roomId != null){
            $room = SeminarRoom::where('id', $this->roomId)->first();
            $this->eventId = $room->event_id;

            $applicants = EventApplicant::where('event_id', $this->eventId)->get();
            $faculties = Faculty::orderBy('code', 'ASC')->paginate(5);

            if ($this->searchModerator !== null) {

                $faculties = Faculty::where('first_name', 'like', '%' . $this->searchModerator . '%')
                    ->orWhere('code', 'like', '%' . $this->searchModerator . '%')
                    ->paginate(5);
            }
        }
        return view('arsys::livewire.event.admin.seminar.add-moderator', compact('faculties', 'room', 'applicants'));
    }

    public function seminarModerator($room_id){
        $this->roomId = $room_id;
        $this->emit('adminSeminarModeratorModal');
    }
    public function assignModerator($faculty_id){
        $moderator = SeminarModerator::where('moderator_id', $faculty_id)
                ->where('room_id', $this->roomId)->first();

        if($moderator == null){
            SeminarModerator::create([
                'room_id' => $this->roomId,
                'moderator_id' => $faculty_id,
            ]);
        }else{
            SeminarModerator::where('id', $moderator->id)->update([
                'room_id' => $this->roomId,
            ]);
        }
    }



    public function closeModal(){
        $this->emit('refreshSeminarApplicant');
        $this->emit('refreshUpcomingEventSeminarComponent');
    }
}
