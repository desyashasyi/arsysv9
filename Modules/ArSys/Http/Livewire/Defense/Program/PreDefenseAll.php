<?php

namespace Modules\ArSys\Http\Livewire\Defense\Program;

use Livewire\Component;
use Modules\ArSys\Entities\EventApplicant;
use Modules\ArSys\Entities\EventType;


use Livewire\WithPagination;
use Carbon\Carbon;

use Auth;

class PreDefenseAll extends Component
{
    use WithPagination;
    public $search;
    protected $listeners = ['predefenseAllMonitoringProgramComponent' => '$refresh'];
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $applicants = EventApplicant::whereHas('event', function($query){
                $query->where('event_type', EventType::where('abbrev', 'PRE')->first()->id);
                })
                ->whereHas('research', function($query){
                    $query->whereHas('student', function($query){
                        $query->where('program_id', Auth::user()->faculty->program_id);
                    })
                    ->where('research_milestone', '>=', 10)
                    ->where('research_milestone', '<=', 15);
                })
                ->paginate(10);



        return view('arsys::livewire.defense.program.pre-defense-all', compact('applicants'));
    }

}
