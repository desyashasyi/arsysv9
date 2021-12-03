<?php

namespace Modules\ArSys\Http\Livewire\Defense\Program;

use Livewire\Component;
use Livewire\WithPagination;

use Auth;
use App\Models\User;
use Modules\ArSys\Entities\Student;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\ResearchMilestone;
use Modules\ArSys\Entities\DefenseRole;
use Modules\ArSys\Entities\DefenseApproval;
use \Carbon\Carbon;

class Approval extends Component
{
    use WithPagination;
    public $search;
    public $alertResearchId;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $students = Student::where('program_id', Auth::user()->faculty->program_id)
                    ->whereHas('research', function($query){
                        $query->whereHas('defenseApproval', function($query) {
                            $query->where('approver_id', Auth::user()->faculty->id)
                                ->where('approver_role', DefenseRole::where('code', 'PRG')->first()->id)
                                ->where('decision', null);
                        });
                    })
                    ->orderBy('first_name', 'ASC')
                    ->paginate(5);

        if ($this->search !== null) {
            $students = Student::where('program_id', Auth::user()->faculty->program_id)
                ->whereHas('research', function($query){
                    $query->whereHas('defenseApproval', function($query) {
                        $query->where('approver_id', Auth::user()->faculty->id)
                            ->where('approver_role', DefenseRole::where('code', 'PRG')->first()->id)
                            ->where('decision', null);
                    });
                })
                ->where('first_name', 'like', '%' . $this->search . '%')
                ->orderBy('first_name', 'ASC')
                ->paginate(5);
        }

        return view('arsys::livewire.defense.program.approval', compact('students'));
    }

    public function approve($id){
        /**
         * Update decision of Research Approval
         */
        DefenseApproval::where('id',$id)->update(['decision' => true, 'approval_date' => Carbon::now()]);

        /**
         * check all research approval has been decided, if so go up to the next milestone
         */
        $approval = DefenseApproval::where('id',$id)->first();
        $approval_count = DefenseApproval::where('research_id', $approval->research_id)->where('decision', null)->get();
        if($approval_count->isEmpty()){
            Research::find($approval->research_id)->increment('research_milestone');
        }

        $this->emit('successMessage', 'The request of student\'s defense has been approved');
    }
}
