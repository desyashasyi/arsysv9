<?php

namespace Modules\ArSys\Http\Livewire\Defense\Student;

use Livewire\Component;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\DefenseReport;

class SubmitReport extends Component
{
    public $researchId;
    public $defenseResume;
    public $defenseDate;
    public $research;

    protected $listeners = ['defenseStudentSubmitReportComponent' => 'defenseReport'];
    public function render()
    {
        $this->research = Research::where('id', $this->researchId)->first();
        return view('arsys::livewire.defense.student.submit-report', ['research' => $this->research]);
    }

    public function defenseReport($id){
        $this->researchId = $id;
        $this->emit('defenseStudentSubmitReportModal');
    }

    public function submitDefenseReport($applicant_id){

        $this->validate([
            'defenseResume' => "required",
            'defenseDate' => "required",
        ]);
        $defenseReport = DefenseReport::where('applicant_id', $applicant_id)
            ->first();
        if(!$defenseReport){
            DefenseReport::create([
                'applicant_id' => $applicant_id,
                'defense_resume' => $this->defenseResume,
                'defense_date' => $this->defenseDate,
            ]);
            $this->emit('hideAll');
            Research::find($this->researchId)->increment('research_milestone');
        }

        $this->emit('successMessage', 'The report of defense has beens successfully submitted');
        $this->emit('refreshResearchIndex');
    }

    public function closeModal(){
        $this->emit('refreshStudentResearchPage');
    }
}
