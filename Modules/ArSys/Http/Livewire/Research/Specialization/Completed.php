<?php

namespace Modules\ArSys\Http\Livewire\Research\Specialization;

use Livewire\Component;
use Livewire\WithPagination;

use Auth;
use App\Models\User;
use Modules\ArSys\Entities\Student;
use Modules\ArSys\Entities\ResearchMilestone;

class Completed extends Component
{
    use WithPagination;
    public $search;
    public $alertResearchId;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $user = Auth::user();

        $students = Student::where('specialization_id', $user->faculty->specialization_id)
                    ->whereHas('research', function($query){
                        $query->where('research_milestone', 10)
                            ->orwhere('research_milestone', 17);
                    })
                    ->orderBy('first_name', 'ASC')
                    ->paginate(10);


        if ($this->search !== null) {
                $students = Student::where('specialization_id', $user->faculty->specialization)
                    ->whereHas('research', function($query){
                        $query->where('research_milestone', 10)
                            ->orwhere('research_milestone', 17);
                    })
                    ->where('first_name', 'like', '%' . $this->search . '%')
                    ->orderBy('first_name', 'ASC')
                    ->paginate(10);
        }
        return view('arsys::livewire.research.specialization.completed', compact('students'));
    }
}
