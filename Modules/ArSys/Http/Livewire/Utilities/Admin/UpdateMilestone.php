<?php

namespace Modules\ArSys\Http\Livewire\Utilities\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\ArSys\Entities\Student;
use Modules\ArSys\Entities\ResearchType;
use Modules\ArSys\Entities\Research;
use Auth;

class UpdateMilestone extends Component
{
    public $search;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $user = Auth::user();

        $students = Student::whereHas('research', function($query){
            $query->where('research_type', '!=', ResearchType::where('code', 'PI')->first()->id)
                    ->where('research_milestone',5);
            })
            ->orderBy('first_name', 'ASC')
            ->paginate(10);

        if ($this->search !== null) {
            $students = Student::whereHas('research', function($query){
                $query->where('research_type', '!=', ResearchType::where('code', 'PI')->first()->id)
                    ->where('research_milestone',5);
                })
                ->where('first_name', 'like', '%' . $this->search . '%')
                ->orderBy('first_name', 'ASC')
                ->paginate(10);
        }


        return view('arsys::livewire.utilities.admin.update-milestone', compact('students'));
    }

    public function upMilestone($research_id){
        Research::find($research_id)->increment('research_milestone');
    }
    public function downMilestone($research_id){
        Research::find($research_id)->decrement('research_milestone');
    }
}
