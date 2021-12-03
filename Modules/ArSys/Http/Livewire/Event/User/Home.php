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
    protected $paginationTheme = 'bootstrap';

    public function render()
    {

        $events = Event::orderBy('event_date', 'DESC')->paginate(3);

        if ($this->search !== null) {
            $events = Event::where('event_id', 'like', '%' . $this->search . '%')
                ->orderBy('event_date', 'DESc')
                ->paginate(3);
        }

        return view('arsys::livewire.event.user.home', compact('events'));
    }



}
