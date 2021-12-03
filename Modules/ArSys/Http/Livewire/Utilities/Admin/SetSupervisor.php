<?php

namespace Modules\ArSys\Http\Livewire\Utilities\Admin;

use Livewire\Component;

use Livewire\WithPagination;
use Modules\ArSys\Entities\Student;
use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\ResearchMilestone;
use Modules\ArSys\Entities\ResearchReviewApproval;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\ResearchSupervisor;
use Modules\ArSys\Entities\ResearchSupervisorDummy;
use Modules\ArSys\Entities\ResearchSupervisorTemp;
use Modules\ArSys\Entities\ResearchType;
use Modules\ArSys\Entities\ResearchDecisionType;
use Modules\ArSys\Entities\ResearchReviewType;
use Auth;

use Carbon\Carbon;

class SetSupervisor extends Component
{
    public $search, $searchFaculty, $researchID;
    public $alertResearchId;
    public $setReviewer = false;
    public $setSupervisor = false;
    public $studentResearch = null;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = [
        'refreshSpecializationReviewHome' => '$refresh',
    ];
    public function render()
    {
        $user = Auth::user();

        /*$milestone = ResearchMilestone::where('milestone', 'Proposal')
                    ->where('phase', 'Submitted')
                    ->orwhere('phase', 'reviewed')
                    ->first();
        */

        $students = Student::whereHas('research', function($query){
                $query->where('research_type', '!=', ResearchType::where('code', 'PI')->first()->id)
                        ->where('research_milestone', 4)
                        //->whereHas('supervisordummy')
                        //->orwhereHas('supervisortemp')
                        ->where('status', 1);
                    })
            ->orderBy('first_name', 'ASC')
            ->paginate(10);

        if ($this->search !== null) {

            Student::whereHas('research', function($query){
                $query->where('research_type', '!=', ResearchType::where('code', 'PI')->first()->id)
                        ->where('research_milestone', 4)
                        //->whereHas('supervisordummy')
                        //->orwhereHas('supervisortemp')
                        ->where('status', 1);
                    })
                ->where('first_name', 'like', '%' . $this->search . '%')
                ->orderBy('first_name', 'ASC')
                ->paginate(10);
        }

        return view('arsys::livewire.utilities.admin.set-supervisor', compact('students'));
    }

    public function approve($research_id){
        $research = Research::where('id', $research_id)->first();
        if ( ResearchSupervisorTemp::where('research_id', $research_id)->count()
            === $research->type->supervisor_number){

                $supervisors = ResearchSupervisorDummy::where('research_id', $research_id)->get();
                foreach($supervisors as $supervisor){
                    ResearchSupervisor::updateOrCreate([
                        'research_id' => $research_id,
                        'supervisor_id' => $supervisor->supervisor_id,
                    ]);
                    ResearchSupervisorDummy::where('id', $supervisor->id)->delete();
                }


                $research = Research::find($research_id);
                $research_model = null;
                if($research->milestone->research_model == 'seminar'){
                    $research_model = 'seminar';
                }else{
                    $research_model = 'defense';
                }

                $milestone = ResearchMilestone::where('milestone_model', $research_model)
                        ->where('phase', 'In Progress')
                        ->first();

                $decision = ResearchDecisionType::where('code', 'APP')->first();
                Research::where('id', $research_id)->update([
                    'status' => $decision->id,
                    'research_milestone' => $milestone->sequence,
                    'approval_date' => Carbon::now(),
                ]);
                $this->alertResearchId = $research_id;
                session()->flash('success', 'The proposal of student\'s research has been approved');
        }elseif( ResearchSupervisorDummy::where('research_id', $research_id)->count()
            > $research->type->supervisor_number){
            $this->alertResearchId = $research_id;
            session()->flash('error', 'Too many supervisor');
        }else{
            $this->alertResearchId = $research_id;
            session()->flash('error', $research->type->supervisor_number.' supervisor should be assigned');
        }
    }
}
