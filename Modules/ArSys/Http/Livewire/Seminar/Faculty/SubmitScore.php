<?php

namespace Modules\ArSys\Http\Livewire\Seminar\Faculty;

use Livewire\Component;
use Modules\ArSys\Entities\SeminarExaminerScore;
use Modules\ArSys\Entities\EventApplicant;
use Modules\ArSys\Entities\DefenseScoreGuide;

class SubmitScore extends Component
{
    public $scoreId;
    public $scoreGuide;
    public $seminarScore;
    public $seminarNote;
    protected $listeners = ['submitSeminarScoreComponent_Faculty' => 'seminarScore_Faculty'];
    public function render()
    {
        $applicant = null;
        if($this->scoreId != null){
            $score = SeminarExaminerScore::where('id', $this->scoreId)->first();
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
            $this->emit('successMessage', 'The mark of student\'s defense has been submitted' );
        }else{
            $this->emit('errorMessage', 'The mark of student\'s defense should not blank' );
        }

    }

    public function closeModal(){

    }
}
