<?php

namespace Modules\ArSys\Http\Livewire\Event\Faculty;

use Livewire\Component;
use Modules\ArSys\Entities\Event;
use \carbon\Carbon;

class Upcoming extends Component
{
    protected $listners=['refreshUpcomingEventComponent' => '$refresh',
        'wirePollEnableUpcomingEventSeminarComponent'=> 'wirePollEnable'];
    //public $eventId;
    public function render()
    {
        $events = Event::where('status', 1)->where('event_date', '>=', Carbon::today())
        ->get();
        return view('arsys::livewire.event.faculty.upcoming', compact('events'));
    }
    public function wirePollEnable(){
        dd('here');
    }
}
