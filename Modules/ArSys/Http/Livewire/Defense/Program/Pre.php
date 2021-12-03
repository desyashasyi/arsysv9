<?php

namespace Modules\ArSys\Http\Livewire\Defense\Program;

use Livewire\Component;
use Modules\ArSys\Entities\Event;
use Modules\ArSys\Entities\EventType;


use Livewire\WithPagination;
use Carbon\Carbon;

use Auth;

class Pre extends Component
{
    use WithPagination;
    public $search;
    protected $listeners = ['predefenseMonitoringProgramComponent' => '$refresh'];
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $events = Event::where('status', 1)
            ->where('event_type', EventType::where('abbrev', 'PRE')->first()->id)
            ->whereHas('applicant', function($query){
                $query->whereHas('research', function($query){
                    $query->whereHas('student', function($query){
                        $query->where('program_id', Auth::user()->faculty->program_id);
                    });
                });
            })
            ->orderBy('event_date', 'DESC')
            ->paginate(1);
        if ($this->search !== null) {
            $events = Event::where('status', 1)
                ->where('event_type', EventType::where('abbrev', 'PRE')->first()->id)
                ->whereHas('applicant', function($query){
                    $query->whereHas('research', function($query){
                        $query->whereHas('student', function($query){
                            $query->where('program_id', Auth::user()->faculty->program_id);
                        });
                    });
                })
                ->orderBy('event_date', 'DESC')
                ->paginate(1);
        }

        return view('arsys::livewire.defense.program.pre', compact('events'));
    }

}
