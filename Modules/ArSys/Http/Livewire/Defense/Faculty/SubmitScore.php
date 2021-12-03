<?php

namespace Modules\ArSys\Http\Livewire\Defense\Faculty;

use Livewire\Component;
use Modules\ArSys\Entities\DefenseExaminer;
use Modules\ArSys\Entities\EventApplicant;
use Modules\ArSys\Entities\DefenseScoreGuide;
use Modules\ArSys\Entities\DefenseExaminerScore;
use Modules\ArSys\Entities\ResearchSupervisorScore;
use Modules\ArSys\Entities\DefenseRole;
use Modules\ArSys\Entities\ResearchSupervisor;
class SubmitScore extends Component
{
    public $applicant;
    public $scoreGuide;
    public $defenseScore;
    public $defenseNote;
    public $score;
    public $scoreId;
    public $roleOfSubmitter;
    protected $listeners = ['defenseFacultySubmitSupervisorScore' => 'submitSupervisorScore',
                            'defenseFacultySubmitExaminerScore' => 'submitExaminerScore'];

    public function render()
    {
        return view('arsys::livewire.defense.faculty.submit-score');
    }

    public function submitExaminerScore($examiner_id){
        $examiner = DefenseExaminer::where('id', $examiner_id)->first();
        $this->applicant = EventApplicant::where('id', $examiner->applicant_id)
            ->where('event_id', $examiner->event_id)->first();

        $this->scoreGuide = DefenseScoreGuide::orderBy('sequence', 'ASC')->get();

        $examinerscore = DefenseExaminerScore::where('event_id', $examiner->event_id)
            ->where('applicant_id', $examiner->applicant_id)
            ->where('examiner_id', $examiner_id)
            ->first();
        if($examinerscore == null){
            $this->defenseScore = '';
            $this->defenseNote = '';
            DefenseExaminerScore::create([
                'event_id' => $examiner->event_id,
                'applicant_id' => $examiner->applicant_id,
                'examiner_id' => $examiner_id,
            ]);
        }else{
            $this->defenseScore = $examinerscore->mark;
            $this->defenseNote = $examinerscore->defense_note;
        }
        $examinerscore = DefenseExaminerScore::where('event_id', $examiner->event_id)
            ->where('applicant_id', $examiner->applicant_id)
            ->where('examiner_id', $examiner_id)
            ->first();
        $this->scoreId = $examinerscore->id;
        $this->emit('defenseFacultySubmitScoreModal');
    }

    public function closeModal(){
        $this->emit('refreshUpcomingEventSeminarComponent');
    }

    public function store($id){
        if($this->defenseScore != null){
            $this->validate([
                'defenseScore' =>'required|digits:3',
            ]);
            if($this->roleOfSubmitter == 'Supervisor'){
                ResearchSupervisorScore::find($id)->update([
                    'mark' => $this->defenseScore,
                    'defense_note' => $this->defenseNote,
                ]);
            }else{
                DefenseExaminerScore::find($id)->update([
                    'mark' => $this->defenseScore,
                    'defense_note' => $this->defenseNote,
                ]);
            }

            $this->emit('successMessage', 'The mark of student\'s defense has been submitted' );
        }else{
            $this->emit('errorMessage', 'The mark of student\'s defense should not blank' );
        }
        $this->roleOfSubmitter == null;

    }

    public function submitSupervisorScore($supervisor_id, $applicant_id){

        $this->applicant = EventApplicant::where('id', $applicant_id)->first();
        $supervisor = ResearchSupervisor::where('id', $supervisor_id)->first();

        $this->scoreGuide = DefenseScoreGuide::orderBy('sequence', 'ASC')->get();

        $supervisorscore = ResearchSupervisorScore::where('event_id', $this->applicant->event_id)
            ->where('applicant_id', $applicant_id)
            ->where('supervisor_id', $supervisor->id)
            ->first();
        if($supervisorscore == null){
            $this->defenseScore = '';
            $this->defenseNote = '';
            ResearchSupervisorScore::create([
                'event_id' => $this->applicant->event_id,
                'applicant_id' => $applicant_id,
                'supervisor_id' => $supervisor->id,
            ]);
        }else{
            $this->defenseScore = $supervisorscore->mark;
            $this->defenseNote = $supervisorscore->defense_note;
        }
        $supervisorscore = ResearchSupervisorScore::where('event_id', $this->applicant->event_id)
            ->where('applicant_id', $applicant_id)
            ->where('supervisor_id', $supervisor->id)
            ->first();
        $this->scoreId = $supervisorscore->id;
        $this->roleOfSubmitter = 'Supervisor';
        $this->emit('defenseFacultySubmitScoreModal');
    }
}
