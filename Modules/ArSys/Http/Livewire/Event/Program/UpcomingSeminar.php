<?php

namespace Modules\ArSys\Http\Livewire\Event\Program;

use Livewire\Component;
use Modules\ArSys\Entities\Event;
use Modules\ArSys\Entities\SeminarRoom;
use Modules\ArSys\Entities\EventType;
use Livewire\WithPagination;
use \Carbon\Carbon;

class UpcomingSeminar extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $event = Event::where('status', 1)->where('event_date', '>=', Carbon::today())
            ->where('event_type', EventType::where('abbrev', 'PUB')->first()->id)
            ->first();
        $rooms = SeminarRoom::where('event_id', $event->id)->paginate(1);
        return view('arsys::livewire.event.program.upcoming-seminar', compact('event', 'rooms'));
    }
}
