<?php

namespace Modules\ArXiv\Http\Livewire\Assignment\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use \Modules\ArSys\Entities\Event;
use \Modules\ArSys\Entities\EventType;

class FinalDefense extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $listeners =['refreshAssignmentAdminFinalDefense' => '$refresh'];
    public function render()
    {
        $events = Event::where('event_type', EventType::where('abbrev', 'PUB')->first()->id)
            ->orderBy('event_date', 'DESC')->paginate(10);
        if ($this->search !== null) {
            $events = Event::where('event_id', 'like', '%' . $this->search . '%')
                ->orderBy('event_date', 'DESC')
                ->paginate(10);
        }
        return view('arxiv::livewire.assignment.admin.final-defense', compact('events'));
    }
}
