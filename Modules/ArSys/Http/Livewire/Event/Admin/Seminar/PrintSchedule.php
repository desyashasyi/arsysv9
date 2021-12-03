<?php

namespace Modules\ArSys\Http\Livewire\Event\Admin\Seminar;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\ArSys\Entities\Event;
use Modules\ArSys\Entities\SeminarRoom;

class PrintSchedule extends Component
{
    public $eventId;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['eventAdminSeminarPrintSchedule' => 'addRoom',
                            ];
    public function render()
    {
        $event = null;
        $rooms = null;
        if($this->eventId){
            $event = Event::where('id', $this->eventId)->first();
            $rooms = SeminarRoom::where('event_id', $this->eventId)->paginate(1);
        }
        return view('arsys::livewire.event.admin.seminar.print-schedule',compact('event', 'rooms'));
    }


    public function addRoom($event_id){
        $this->eventId = $event_id;
       $this->emit('eventAdminSeminarPrintScheduleModal');
    }

    public function closeModal(){
    }
}
