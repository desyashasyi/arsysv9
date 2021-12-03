<?php

namespace Modules\ArSys\Http\Livewire\Review\Specialization\Proposal;

use Livewire\Component;

use Livewire\WithPagination;
use Modules\ArSys\Entities\Student;
use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\ResearchMilestone;
use Modules\ArSys\Entities\ResearchReviewApproval;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\ResearchSupervisor;
use Modules\ArSys\Entities\ResearchSupervisorExternal;
use Modules\ArSys\Entities\ResearchSupervisorDummy;
use Modules\ArSys\Entities\ResearchSupervisorExternalDummy;
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

        $students = Student::where('specialization_id', $user->faculty->specialization_id)
            ->whereHas('research', function($query){
                $query->where('research_type', '!=', ResearchType::where('code', 'PI')->first()->id)
                        ->where('research_milestone', 2)->orwhere('research_milestone', 3)
                        ->where('status', null);
                    })
            ->orderBy('first_name', 'ASC')
            ->paginate(10);

        if ($this->search !== null) {
            $students = Student::where('specialization_id', $user->faculty->specialization_id)
            ->whereHas('research', function($query){
                $query->where('research_type', '!=', ResearchType::where('code', 'PI')->first()->id)
                        ->where('research_milestone', 2)->orwhere('research_milestone', 3)
                        ->where('status', null);
                    })
                ->where('first_name', 'like', '%' . $this->search . '%')
                ->orderBy('first_name', 'ASC')
                ->paginate(10);
        }


        /*$faculties = Faculty::orderBy('code', 'ASC')
                    ->paginate(5);

        if ($this->searchFaculty !== null) {
            $faculties = Faculty::where('first_name', 'like', '%' . $this->searchFaculty . '%')
                ->orwhere('code', 'like', '%' . $this->searchFaculty . '%')
                ->orderBy('code', 'ASC')
                ->paginate(5);
        }




        if($this->setReviewer || $this->setSupervisor){
            $this->studentResearch = Research::where('id', $this->researchID)->first();
        }*/

        return view('arsys::livewire.review.specialization.proposal.home', compact('students'));
    }

    /*public function setReviewer($id){
        $this->researchID = $id;
        $this->setReviewer = true;
    }

    public function setSupervisor($id){
        $this->researchID = $id;
        $this->setSupervisor = true;
    }*/

    /*public function assignReviewer($research_id, $faculty_id){

        $approval = ResearchReviewApproval::where('research_id', $research_id)
            ->where('reviewer_id', $faculty_id)
            ->first();

        if($approval == null){
            ResearchReviewApproval::updateOrCreate([
                'research_id' => $research_id,
                'reviewer_id' => $faculty_id,
            ]);
        }

        if (ResearchReviewApproval::where('research_id', $research_id)->count() == 1){
            Research::find($research_id)->increment('research_milestone');
        }

    }
    public function unAssignReviewer($research_id, $faculty_id){
        ResearchReviewApproval::where('research_id', $research_id)->where('reviewer_id', $faculty_id)
            ->delete();
        if (ResearchReviewApproval::where('research_id', $research_id)->count() == 0){
                Research::find($research_id)->decrement('research_milestone');
        }
    }

    public function assignSupervisor($research_id, $faculty_id){


            //dd($supervisor->count());

        if(ResearchSupervisorDummy::where('research_id', $research_id)->count()
            <  Research::where('id', $research_id)->first()->type->supervisor_number){


            if (ResearchSupervisorDummy::where('research_id', $research_id)
                ->where('supervisor_id', $faculty_id)
                ->first() == null){
                    ResearchSupervisorDummy::updateOrCreate([
                        'research_id' => $research_id,
                        'supervisor_id' => $faculty_id,
                    ]);
            }

        }
    }*/
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
    public function presentation($research_id){

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

        $decision = ResearchDecisionType::where('code', 'PRS')->first();

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

        $research = Research::where('id', $research_id)->first();
        if($research->type->supervisor_number == 2){
            if(ResearchSupervisorDummy::where('research_id', $research_id)->get()
            ->contains('supervisor_id', Faculty::where('code', 'EXT')->first()->id)){
                $supervisorsExternal = ResearchSupervisorExternalDummy::where('research_id', $research_id)->get();
                foreach($supervisorsExternal as $supervisor){
                    ResearchSupervisorExternal::updateOrCreate([
                        'research_id' => $research_id,
                        'supervisor_id' => $supervisor->supervisor_id,
                    ]);
                    ResearchSupervisorExternalDummy::where('id', $supervisorsExternal->id)->delete();
                }
            }
        }elseif($research->type->supervisor_number == 1){
            $supervisorsExternal = ResearchSupervisorExternalDummy::where('research_id', $research_id)->get();
            foreach($supervisorsExternal as $supervisor){
                ResearchSupervisorExternal::updateOrCreate([
                    'research_id' => $research_id,
                    'supervisor_name' => $supervisor->supervisor_name,
                    'institution' => $supervisor->institution,
                ]);
                ResearchSupervisorExternalDummy::where('id', $supervisorsExternal->id)->delete();
            }
        }
    }
}
