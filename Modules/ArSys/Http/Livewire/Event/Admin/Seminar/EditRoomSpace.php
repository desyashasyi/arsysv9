<?php

namespace Modules\ArSys\Http\Livewire\Event\Admin\Seminar;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\ArSys\Entities\EventSpace;
use Modules\ArSys\Entities\SeminarRoom;

class EditRoomSpace extends Component
{
    protected $listeners = ['eventAdminSeminarEditRoomSpace' => 'editSpace'];
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $roomId;
    public $spaceId;
    public function render()
    {

        return view('arsys::livewire.event.admin.seminar.edit-room-space',[
            'spaces' => EventSpace::orderBy('description', 'ASC')->paginate(5),
        ]);
    }
    public function editSpace($room_id){
        $this->spaceId = null;
        $this->roomId = $room_id;
        $this->emit('eventAdminSeminarEditRoomSpaceModal');
    }

    public function closeModal(){
        $this->spaceId = null;
        $this->emit('refreshSeminarApplicant');
    }
    public function submitSpace($space_id){
        $this->spaceId = $space_id;
        SeminarRoom::where('id', $this->roomId)->update([
            'space_id' => $space_id,
        ]);
    }
}
