<?php

namespace Modules\ArSys\Http\Livewire\Research\Student;

use Livewire\Component;

use Livewire\WithFileUploads;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\ResearchMilestone;
use Modules\ArSys\Entities\ResearchMilestoneSeminar;
use Modules\ArSys\Entities\ResearchSupervisor;
use Modules\ArSys\Entities\ResearchFile;
use Modules\ArSys\Entities\ResearchReviewApproval;
use Modules\ArSys\Entities\DefenseApproval;
use Modules\ArSys\Entities\DefenseRole;
use Modules\ArSys\Entities\DefenseModel;
use Modules\ArSys\Entities\ArSysConfig;
use Modules\ArSys\Entities\EventApplicant;
use Modules\ArSys\Entities\Faculty;
use Auth;
use Storage;

class Home extends Component
{
    use WithFileUploads;
    public $researchId;
    public $user;
    public $researchs;
    public $deleteConfirmation = null;
    public $proposalButton = null;

    protected $listeners = [
                            'refreshResearchIndex' => '$refresh',
                            'refreshStudentResearchPage' => '$refresh',
                        ];


    public function mount(){
        $this->deleteConfirmation = false;
        $this->proposalButton = false;
        $this->researchs = null;
    }

    public function render()
    {
        $this->user = Auth::user();
        $this->researchs = null;
        if($this->user->student != null ){
            $this->researchs = Research::where('student_id', $this->user->student->id)->get();
        }
        return view('arsys::livewire.research.student.home');
    }

    public function eventDetail($id){
        return redirect()->route('arsys.event.student', ['id' => $id]);
    }

    public function propose($id){

        $user = Auth::user();

        $research = Research::where('id', $id)->first();
        /**
        * Propose system for Defense model
        */
        if($research->type->research_model == 'defense'){
            if($research->milestone->sequence === 1){
                Research::find($id)->increment('research_milestone');
            }

            if($research->milestone->sequence === ResearchMilestone::where('milestone', 'Pre-defense')
                                                        ->where('phase', 'In progress')->first()->sequence
            ){

                $config = ArSysConfig::where('code', 'SPV_BYPASS')->first();
                if($config->status == 1){

                    foreach($research->supervisor as $supervisor){
                        DefenseApproval::create([
                            'approver_id' => $supervisor->faculty->id,
                            'approver_role' => DefenseRole::where('code', 'SPV')->first()->id,
                            'research_id' => $research->id,
                            'defense_model' => DefenseModel::where('code', 'PRE')->first()->id,
                        ]);
                    }
                    Research::find($id)->increment('research_milestone');
                }
            }

            if($research->milestone->sequence === ResearchMilestone::where('milestone', 'Final-defense')
                                                    ->where('phase', 'In progress')->first()->sequence
            ){
                foreach($research->supervisor as $supervisor){
                    DefenseApproval::create([
                        'approver_id' => $supervisor->faculty->id,
                        'approver_role' => DefenseRole::where('code', 'SPV')->first()->id,
                        'research_id' => $research->id,
                        'defense_model' => DefenseModel::where('code', 'PUB')->first()->id,
                    ]);
                }

                $faculty = Faculty::where('program_id', $this->user->student->program_id)->first();
                DefenseApproval::create([
                    'approver_id' => $faculty->id,
                    'approver_role' => DefenseRole::where('code', 'PRG')->first()->id,
                    'research_id' => $research->id,
                    'defense_model' => DefenseModel::where('code', 'PUB')->first()->id,
                ]);
                Research::find($id)->increment('research_milestone');
                $this->emit('successMessage', 'The approval of final defense has been requested');
            }
        }

        if($research->type->research_model == 'seminar'){
            if($research->milestone->sequence === 1){
                Research::find($id)->increment('research_milestone');
            }

            if($research->milestone->sequence === ResearchMilestoneSeminar::where('milestone', 'Seminar TE')
                                                        ->where('phase', 'In progress')->first()->sequence)
            {

                $config = ArSysConfig::where('code', 'SPV_BYPASS')->first();
                if($config->status == 1){

                    foreach($research->supervisor as $supervisor){
                        DefenseApproval::create([
                            'approver_id' => $supervisor->faculty->id,
                            'approver_role' => DefenseRole::where('code', 'SPV')->first()->id,
                            'research_id' => $research->id,
                            'defense_model' => DefenseModel::where('code', 'SEM')->first()->id,
                        ]);
                    }
                    Research::find($id)->increment('research_milestone');
                    $this->emit('successMessage', 'The approval of STE has been requested');
                }
            }
        }
    }


    public function proposeSeminar(){

        /**
        * Propose system for Seminar model
        */
        if($research->type->research_model == 'seminar'){
            if($research->milestoneseminar->sequence === 1){
                Research::find($id)->increment('research_milestone');
            }


        }
    }

    public function deleteResearch($id)
    {
        $this->deleteConfirmation = true;
        $this->researchId = $id;
    }

    public function deleteProceed($id)
    {


        $research = Research::where('id', $id)->first();

        if($research->supervisor != null){
            foreach($research->supervisor as $supervisor){
                ResearchSupervisor::destroy($supervisor->id);
            }
        }

        $file = ResearchFile::where('research_id', $id)->first();
        if (!empty($file)){
            ResearchFile::where('research_id', $id)->delete();
            Storage::delete($file->filename);
        }

        Research::destroy($id);


        $this->deleteConfirmation = false;
    }

    public function deleteCancel()
    {
        $this->deleteConfirmation = false;
    }

    public function removeEventApplication($applicant_id, $research_id){
        Research::find($research_id)->decrement('research_milestone');
        EventApplicant::where('id', $applicant_id)->delete();
    }

    public function cancelDefenseApproval($research_id){
        $research = Research::where('id', $research_id)->first();
        if($research->approvalRequest->isNotEmpty()){
            foreach($research->approvalRequest as $request){
                DefenseApproval::find($request->id)->delete();
            }

            Research::find($research_id)->decrement('research_milestone');
        }

    }

}
