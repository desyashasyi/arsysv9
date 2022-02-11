<?php

namespace Modules\ArSys\Http\Livewire\Event\User;

use Livewire\Component;

use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\Event;
use Modules\ArSys\Entities\EventType;

use Livewire\WithPagination;
use Carbon\Carbon;
class Home extends Component
{


    use WithPagination;
    public $search;
    public $eventTypeId = null;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['selectEventType' => 'selectEventType',
                            'selfRefresh' => '$refresh'];

    public function render()
    {

        /*$events = Event::orderBy('event_date', 'DESC')->paginate(3);

        if ($this->search !== null) {
            $events = Event::where('event_id', 'like', '%' . $this->search . '%')
                ->orderBy('event_date', 'DESc')
                ->paginate(3);
        }
        */
        $events = null;
        if($this->eventTypeId != null){
            $events = Event::where('event_type', $this->eventTypeId)
                ->orderBy('event_date', 'DESc')
                ->paginate(3);
        }

        return view('arsys::livewire.event.user.home', compact('events'));
    }

    public function selectEventType($eventTypeId){
        $this->eventTypeId = $eventTypeId['eventTypeId'];
        $this->resetPage();
    }


}
