<?php

namespace Modules\Timetable\Http\Livewire\Schedule\Admin;

use Livewire\Component;

use Livewire\WithFileUploads;
use Modules\Timetable\Imports\FETTimetableImport;
use Maatwebsite\Excel\Facades\Excel;

class Import extends Component
{
    use WithFileUploads;
    public $fileTimetable;
    public $programId;
    public $listeners = ['FETTimetableImporterAdmin' => 'importTimetable',
                            'selectProgram' => 'fillProgram'
                        ];
    public function render()
    {
        return view('timetable::livewire.schedule.admin.import');
    }

    public function fillProgram($programId){
        $this->programId = $programId['programId'];
    }
    public function importTimetable(){
        $this->fileTimetable = '';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('resetProgramSelection',[]);
        $this->emit('importTimetableModal');
    }

    public function submitTimetable(){

        $this->validate([
            'fileTimetable' => "required|max:10000",
        ]);
        $path1 = $this->fileTimetable->store('temp');
        $path=storage_path('app').'/'.$path1;
        Excel::import(new FETTimetableImport($this->programId), $path);
    }
}
