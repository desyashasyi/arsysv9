<?php

namespace Modules\ArSys\Http\Livewire\Seminar\Program;

use Livewire\Component;

class EditScore extends Component
{
    protected $listeners = ['editSeminarExaminerScoreComponent' => 'editExaminerScore',
                            'editNullSeminarExaminerScoreComponent' => 'editNullExaminerScore'];
    public function render()
    {
        return view('arsys::livewire.seminar.program.edit-score');
    }

    public function editExaminerScore(){

    }

    public function editNullExaminerScore(){

    }
}
