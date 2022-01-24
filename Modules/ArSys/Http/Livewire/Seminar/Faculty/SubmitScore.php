<?php

namespace Modules\ArSys\Http\Livewire\Seminar\Faculty;

use Livewire\Component;
use Modules\ArSys\Entities\SeminarExaminerScore;
use Modules\ArSys\Entities\EventApplicant;
use Modules\ArSys\Entities\DefenseScoreGuide;
use Modules\ArSys\Entities\ResearchSupervisorScore;
use Auth;

class SubmitScore extends Component
{
    public $scoreId;
    public $scoreSupervisorId;
    public $scoreGuide;
    public $seminarScore;
    public $seminarNote;
    protected $listeners = ['submitSeminarScoreComponent_Faculty' => 'seminarScore_Faculty',
                            'submitSeminarScoreComponent_FacultySupervisor' => 'seminarScore_FacultySupervisor'];
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
        return view('arsys::livewire.seminar.faculty.submit-score', compact('applicant'));
    }

    public function seminarScore_Faculty($score_id){
        $this->scoreId = $score_id;
        $this->scoreGuide = DefenseScoreGuide::orderBy('sequence', 'ASC')->get();
        $this->emit('submitSeminarScoreModal');
    }

    public function store($score_id){
        if($this->seminarScore != null){
            $this->validate([
                'seminarScore' =>'required|digits:3',
            ]);
            SeminarExaminerScore::find($score_id)->update([
                'mark' => $this->seminarScore,
                'seminar_note' => $this->seminarNote,
            ]);

            
            $score = SeminarExaminerScore::where('id', $score_id)->first();
            $room_id = $score->applicant->room_id;
            
            $applicants = EventApplicant::where('room_id', $room_id)->get();

            foreach($applicants as $applicant){
                if($applicant->id == $score->applicant->id){
                    if($applicant->research->supervisor->contains('supervisor_id', Auth::user()->faculty->id)){
                        foreach($applicant->research->supervisor as $supervisor){
                            $scoreSupervisor = ResearchSupervisorScore::where('supervisor_id', $supervisor->id)->first();
                            if($scoreSupervisor == NULL){
                                ResearchSupervisorScore::create([
                                    'event_id' => $applicant->event_id,
                                    'applicant_id' => $applicant->id,
                                    'supervisor_id' => $supervisor->id,
                                ]);
                            }
                            ResearchSupervisorScore::where('supervisor_id', $supervisor->id)->update([
                                'mark' => $this->seminarScore,
                            ]);

                        }
                    }
                }
            }
            $this->emit('successMessage', 'The mark of student\'s defense has been submitted' );
        }else{
            $this->emit('errorMessage', 'The mark of student\'s defense should not blank' );
        }

        
    }


    public function seminarScore_FacultySupervisor($supervisor_id, $event_id, $applicant_id){
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
        $this->emit('submitSeminarScoreSupervisorModal');
    }

    public function storeSupervisor($score_id){
        if($this->seminarScore != null){
            $this->validate([
                'seminarScore' =>'required|digits:3',
            ]);
            ResearchSupervisorScore::find($score_id)->update([
                'mark' => $this->seminarScore,
                'seminar_note' => $this->seminarNote,
            ]);
            $this->emit('successMessage', 'The mark of student\'s defense has been submitted' );
        }else{
            $this->emit('errorMessage', 'The mark of student\'s defense should not blank' );
        }
        $this->emitUp('refreshTestUpcomingEventComponent');
    }
    public function closeModal(){
        $this->emitUp('refreshTestUpcomingEventComponent');
    }
}
