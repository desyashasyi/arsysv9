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
    protected $listners=['refreshSeminarUpcomingComponent' => 'refreshSeminarUpcoming',
                        ];
    public $eventId;
    public $currentRoom = null;
    public function render()
    {
        $event = Event::where('id', $this->eventId)->first();
        return view('arsys::livewire.event.faculty.upcoming-seminar', compact('event'));
    }

    public function mount($id){
        $this->eventId = $id;
    }

    public function refreshSeminarUpcoming(){
        dd('here');
        $this->emit('refreshUpcomingEventComponent');
    }


    

}
