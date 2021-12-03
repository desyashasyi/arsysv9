<?php

namespace Modules\ArSys\Http\Livewire\Utilities\Admin\Event;

use Livewire\Component;
use Modules\ArSys\Entities\Event;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $events = Event::doesnthave('applicant')->get();
        return view('arsys::livewire.utilities.admin.event.home', compact('events'));
    }

    public function delete($event_id){
        Event::find($event_id)->delete();
    }
}
