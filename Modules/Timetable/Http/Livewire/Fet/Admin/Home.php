<?php

namespace Modules\Timetable\Http\Livewire\Fet\Admin;

use Livewire\Component;
use Modules\Timetable\Entities\Fet;
use Modules\Timetable\Entities\FetTeacher;
use Modules\Timetable\Exports\FetTeacherExport;
use Maatwebsite\Excel\Facades\Excel;

class Home extends Component
{
    public $programId;
    public $listeners = ['selectStudyProgram' => 'fillProgram'];
    public function render()
    {
        $fets = Fet::all();
        return view('timetable::livewire.fet.admin.home', compact('fets'));
    }
    public function fillProgram($studyProgramId){
        $this->programId = $studyProgramId['studyProgramId'];
    }

    public function data($fet_id){
        $fet = Fet::where('id', $fet_id)->first();
        $emiter = 'fet'.$fet->component.'Data';
        $this->emit($emiter);
    }

    public function export($fet_id){
        $fet = Fet::where('id', $fet_id)->first();
        if($fet->code == 'TC'){
            $teacher = FetTeacher::all();
            //$teacher = Teacher::where('program_id');
            return Excel::download(new FetTeacherExport($teacher), 'FetTeacher.csv');
        }elseif($fet->code == 'ST'){

        }elseif($fet->code == 'SU'){

        }
    }
}
