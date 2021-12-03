<?php

namespace Modules\ArSys\Http\Livewire\Defense\Program;

use Livewire\Component;
use Modules\ArSys\Entities\DefenseExaminer;
use Modules\ArSys\Entities\EventApplicant;
use Modules\ArSys\Entities\DefenseScoreGuide;
use Modules\ArSys\Entities\DefenseExaminerScore;

class EditScore extends Component
{
    protected $listeners = ['editExaminerScoreComponent' => 'editExaminerScore'];
    public $applicant;
    public $scoreGuide;
    public $defenseScore;
    public $defenseNote;
    public $scoreId;
    public $examiner;
    public function render()
    {
        return view('arsys::livewire.defense.program.edit-score');
    }

    public function editExaminerScore($examiner_id){
        /*$this->examiner = DefenseExaminer::where('id', $examiner_id)->first();
        //dd($examiner->faculty->code);
        $this->scoreGuide = DefenseScoreGuide::orderBy('sequence', 'ASC')->get();
        $this->applicant = EventApplicant::where('id', $this->examiner->applicant_id)->first();
        //dd($this->applicant->research->student->first_name);
        if($this->examiner->examinerscore != null){
            $score = DefenseExaminerScore::where('id', $examiner_id)->first();
            $this->defenseScore = $score->mark;
            $this->defenseNote = $score->defense_note;
            $this->scoreId = $score->id;
            $this->emit('editExaminerScoreModal');
        }else{
            $score = DefenseExaminerScore::create([
                'event_id' => $this->examiner->event_id,
                'applicant_id' => $this->examiner->applicant_id,
                'examiner_id' => $this->examiner->id,
            ]);
            $this->defenseScore = '';
            $this->defenseNote = '';
            $this->scoreId = $score->id;
            $this->emit('editExaminerScoreModal');

        }
        */
    }

    public function store($id){
        if($this->defenseScore != null){
            $this->validate([
                'defenseScore' =>'required|digits:3',
            ]);

            DefenseExaminerScore::find($id)->update([
                'mark' => $this->defenseScore,
                'defense_note' => $this->defenseNote,
            ]);

            $this->emit('successMessage', 'The mark of student\'s defense has been submitted' );
        }else{
            $this->emit('errorMessage', 'The mark of student\'s defense should not blank' );
        }
    }

    public function closeModal(){
        $this->emit('predefenseMonitoringProgramComponent');
    }
}
