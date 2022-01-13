<?php

namespace Modules\ArSys\Http\Livewire\Seminar\Program;


use Livewire\Component;
use Modules\ArSys\Entities\SeminarExaminerScore;
use Modules\ArSys\Entities\EventApplicant;
use Modules\ArSys\Entities\DefenseScoreGuide;
use Modules\ArSys\Entities\ResearchSupervisorScore;
class EditSeminarScore extends Component
{
    public $scoreId;
    public $scoreSupervisorId;
    public $scoreGuide;
    public $seminarScore;
    public $seminarNote;
    protected $listeners = ['editSupervisorSeminarScoreComponent_Program' => 'seminarSupervisorScore_Program'];
                            
    public function render()
    {
        $applicant = null;
        if($this->scoreId != NULL){
            $score = SeminarExaminerScore::where('id', $this->scoreId)->first();
            $applicant = EventApplicant::where('id', $score->applicant_id)->first();
        }

        if($this->scoreSupervisorId != NULL){
            $score = ResearchSupervisorScore::where('id', $this->scoreSupervisorId)->first();
            $applicant = EventApplicant::where('id', $score->applicant_id)->first();
        }
        return view('arsys::livewire.seminar.program.edit-seminar-score', compact('applicant'));
    }

    


    public function seminarSupervisorScore_Program($supervisor_id, $event_id, $applicant_id){
        $scoreSupervisor = ResearchSupervisorScore::where('supervisor_id', $supervisor_id)->first();
        if($scoreSupervisor == NULL){
            ResearchSupervisorScore::create([
                'event_id' => $event_id,
                'applicant_id' => $applicant_id,
                'supervisor_id' => $supervisor_id,
            ]);
        }
        $this->scoreSupervisorId = ResearchSupervisorScore::where('supervisor_id', $supervisor_id)->first()->id;
        $this->scoreGuide = DefenseScoreGuide::orderBy('sequence', 'ASC')->get();
        $this->seminarScore = null;
        $this->emit('editSeminarScoreModal_Program');
    }

    public function storeSupervisor($score_id){
        if($this->seminarScore != null){
            $this->validate([
                //'seminarScore' =>'required|digits:3',
            ]);
            ResearchSupervisorScore::find($score_id)->update([
                'mark' => $this->seminarScore,
                'seminar_note' => $this->seminarNote,
            ]);
            $this->emit('successMessage', 'The mark of student\'s defense has been submitted' );
        }else{
            $this->emit('errorMessage', 'The mark of student\'s defense should not blank' );
        }
       
    }
    public function closeModal(){

    }
}
