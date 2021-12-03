<?php

namespace Modules\ArSys\Http\Livewire\Research\Admin;

use Livewire\Component;
use Livewire\WithPagination;

use Auth;
use App\Models\User;
use Modules\ArSys\Entities\Student;
use Modules\ArSys\Entities\ResearchMilestone;

class Home extends Component
{
    use WithPagination;
    public $search;
    public $alertResearchId;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $user = Auth::user();


        $students = Student::whereHas('research', function($query){
                        $query->where('status', null)->where('research_milestone',1)
                        ->orwhere('research_milestone',2)->orWhere('research_milestone',3);
                          
                    })
                    ->orderBy('first_name', 'ASC')
                    ->paginate(10);

        if ($this->search !== null) {
                $students = Student::where('specialization_id', $user->faculty->specialization)
                    ->whereHas('research', function($query){
                        $query->where('status', null)->where('research_milestone',2)->orWhere('research_milestone',3);
                    })
                    ->where('first_name', 'like', '%' . $this->search . '%')
                    ->orderBy('first_name', 'ASC')
                    ->paginate(10);
        }

        return view('arsys::livewire.research.admin.home', compact('students'));
    }
}