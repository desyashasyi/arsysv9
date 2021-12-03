<?php

namespace Modules\ArSys\Http\Livewire\Defense\Student;

use Livewire\Component;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\DefenseReport;

class EditReport extends Component
{
    public $defenseResume;
    public $defenseDate;
    public $report = null;
    public $reportId = null;

    protected $listeners = ['defenseStudentEditReportComponent' => 'editReport'];

    public function mount(){
        $this->defenseResume = null;
        $this->defenseDate = null;
        $this->report = null;
        $this->reportId = null;
    }
    public function render()
    {
        return view('arsys::livewire.defense.student.edit-report');
    }

    public function editReport($id){
        $this->reportId = $id;
        $this->report = DefenseReport::where('id', $this->reportId)->first();
        $this->defenseResume = $this->report->defense_resume;
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('defenseStudentEditReportModal');
    }

    public function updateDefenseReport($id){
        $this->validate([
            'defenseResume' => "required",
            'defenseDate' => "required",
        ]);
        DefenseReport::find($id)->update([
            'defense_resume' => $this->defenseResume,
            'defense_date' => $this->defenseDate,
        ]);
        $this->resetErrorBag();
        $this->resetValidation();

        $this->emit('successMessage', 'The report of defense has been successfully updated');
        $this->emit('refreshStudentResearchPage');
    }
    public function closeModal(){
        $this->emit('refreshStudentResearchPage');
    }
}
