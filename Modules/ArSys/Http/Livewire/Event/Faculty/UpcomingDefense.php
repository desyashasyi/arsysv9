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
    public $eventId;
    public function render()
    {
        $event = Event::where('id', $eventId)->first();

        return view('arsys::livewire.event.faculty.upcoming-defense', compact('event'));
    }

    public function mount($id){
        $this->eventId = $id;
    }

    
}
