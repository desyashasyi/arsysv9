<?php

namespace Modules\ArSys\Http\Livewire\Event\Admin\Seminar;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\ArSys\Entities\EventSession;
use Modules\ArSys\Entities\SeminarRoom;

class EditRoomSession extends Component
{
    protected $listeners = ['eventAdminSeminarEditRoomSession' => 'editSession'];
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $roomId;
    public $sessionId;
    public function render()
    {
        return view('arsys::livewire.event.admin.seminar.edit-room-session',[
            'sessions' => EventSession::where('type', 'seminar')->orderBy('time', 'ASC')->paginate(5),
        ]);
    }

    public function editSession($room_id){
        $this->sessionId = null;
        $this->roomId = $room_id;
        $this->emit('eventAdminSeminarEditRoomSessionModal');
    }

    public function closeModal(){
        $this->sessionId = null;
        $this->emit('refreshSeminarApplicant');
    }
    public function submitSession($session_id){
        $this->sessionId = $session_id;
        SeminarRoom::where('id', $this->roomId)->update([
            'session_id' => $session_id,
        ]);
    }
}
