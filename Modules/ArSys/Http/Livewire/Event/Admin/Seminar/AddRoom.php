<?php

namespace Modules\ArSys\Http\Livewire\Event\Admin\Seminar;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\Event;
use Modules\ArSys\Entities\SeminarRoom;


class AddRoom extends Component
{
    public $searchExaminer;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchModerator;
    public $eventId;
    public $moderator;
    public $moderatorId;
    public $spaceId;
    public $sessionId;
    protected $listeners = ['seminarAddRoomComponent' => 'addRoom',
                            'selectEventSessionSetting' => 'sessionEventSetting',
                            'selectEventSpaceSetting' => 'spaceEventSetting'
                            ];
    public function render()
    {
        $rooms = SeminarRoom::where('event_id', $this->eventId)->get();

        $faculties = null;
        if ($this->searchModerator !== null) {
            $faculties = Faculty::where('first_name', 'like', '%' . $this->searchModerator . '%')
                ->orWhere('code', 'like', '%' . $this->searchModerator . '%')
                ->paginate(5);
        }
        return view('arsys::livewire.event.admin.seminar.add-room', compact('rooms', 'faculties'));
    }

    public function sessionEventSetting($sessionId)
    {
        $this->sessionId = $sessionId['sessionId'];
    }

    public function spaceEventSetting($spaceId)
    {
        $this->spaceId = $spaceId['spaceId'];

    }
    public function addRoom($event_id){
        $this->clearFields();
        $this->eventId = $event_id;
        $this->emit('seminarAddRoomModal');
    }

    public function assignModerator($faculty_id){
        $this->searchModerator = null;
        $this->moderatorId = $faculty_id;
        if($this->moderatorId != null){
            $this->moderator = Faculty::where('id', $faculty_id)->first();
        }
    }

    public function submitRoom(){

        //dd($this->sessionId, $this->spaceId);
        $room_code = Event::where('id', $this->eventId)->first()->type->abbrev;
        $counter = SeminarRoom::where('event_id', $this->eventId)->count();
        $counter = $counter+1;
        $room_code = $room_code.$counter;
        SeminarRoom::create([
            'event_id' => $this->eventId,
            'session_id' => $this->sessionId,
            'space_id' => $this->spaceId,
            'moderator_id' => $this->moderatorId,
            'room_code' => $room_code,
        ]);
        $this->clearFields();
    }

    public function clearFields(){
        $this->spaceId = null;
        $this->sessionId = null;
        $this->dispatchBrowserEvent('resetSession',[]);
        $this->dispatchBrowserEvent('resetSpace',[]);
        $this->moderatorId = null;
        $this->moderator = null;
        $this->searchModerator = null;
    }

    public function closeModal(){
        $this->emit('refreshSeminarApplicant');
    }
}
