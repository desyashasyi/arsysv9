<?php

namespace Modules\ArSys\Http\Livewire\Review\Coordinator;

use Livewire\Component;

use Livewire\WithPagination;
use Modules\ArSys\Entities\Student;
use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\ResearchMilestone;
use Modules\ArSys\Entities\ResearchReviewApproval;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\ResearchSupervisor;
use Modules\ArSys\Entities\ResearchSupervisorDummy;
use Modules\ArSys\Entities\ResearchType;
use Modules\ArSys\Entities\ResearchDecisionType;
use Modules\ArSys\Entities\ResearchReviewType;
use Auth;

use Carbon\Carbon;


class Home extends Component
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

        $students = Student::
            whereHas('research', function($query){
                $query->where('research_type', ResearchType::where('code', 'PI')->first()->id)
                        ->where('research_milestone', 2)
                        ->where('status', null);
                    })
            ->orderBy('first_name', 'ASC')
            ->paginate(10);

        if ($this->search !== null) {
            $students = Student::
            whereHas('research', function($query){
                $query->where('research_type', ResearchType::where('code', 'PI')->first()->id)
                        ->where('research_milestone', 2)
                        ->where('status', null);
                    })
                ->where('first_name', 'like', '%' . $this->search . '%')
                ->orderBy('first_name', 'ASC')
                ->paginate(10);
        }



        return view('arsys::livewire.review.coordinator.home', compact('students'));
    }

    public function unAssignSupervisor($research_id, $faculty_id){
        ResearchSupervisorDummy::where('research_id', $research_id)->where('supervisor_id', $faculty_id)
            ->delete();
    }

    public function reject($research_id){

        $research = Research::find($research_id);
        $research_model = null;
        if($research->milestone->research_model == 'seminar'){
            $research_model = 'seminar';
        }else{
            $research_model = 'defense';
        }


        $milestone = ResearchMilestone::where('milestone', 'Rejected')
                ->first();

        $decision = ResearchDecisionType::where('code', 'RJC')->first();

        Research::find($research_id)->update(['research_milestone' => $milestone->sequence]);
        Research::where('id', $research_id)->update([
            'status' => $decision->id,
            'approval_date' => Carbon::now(),
        ]);
    }
    public function revise($research_id){
        $research = Research::find($research_id);
        $research_model = null;
        if($research->milestone->research_model == 'seminar'){
            $research_model = 'seminar';
        }else{
            $research_model = 'defense';
        }


        $milestone = ResearchMilestone::where('milestone', 'Proposal')
                ->where('milestone_model', $research_model)
                ->where('phase', 'Reviewed')
                ->first();

        $decision = ResearchDecisionType::where('code', 'RVS')->first();

        Research::find($research_id)->update(['research_milestone' => $milestone->sequence]);
        Research::where('id', $research_id)->update([
            'status' => $decision->id,
            'approval_date' => Carbon::now(),
        ]);
    }
    public function approve($research_id){

        $research = Research::where('id', $research_id)->first();
        if ( ResearchSupervisorDummy::where('research_id', $research_id)->count()
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

