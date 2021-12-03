<?php

namespace Modules\Timetable\Http\Livewire\Subject\Admin;

use Livewire\Component;

use Livewire\WithFileUploads;
use Modules\Timetable\Imports\CurriculumImport;
use Maatwebsite\Excel\Facades\Excel;

class Import extends Component
{
    use WithFileUploads;
    public $fileSubject;
    public $programId;
    public $listeners = ['subjectImporterAdmin' => 'importSubject',
                            'selectProgram' => 'fillProgram'
                        ];
    public function render()
    {
        return view('timetable::livewire.subject.admin.import');
    }

    public function fillProgram($programId){
        $this->programId = $programId['programId'];
    }
    public function importSubject(){
        $this->fileSubject = '';
        $this->resetErrorBag();
        $this->resetValidation();
        $this->dispatchBrowserEvent('resetProgramSelection',[]);
        $this->emit('importSubjectModal');
    }

    public function submitSubjects(){

        $this->validate([
            'fileSubject' => "required|max:10000",
        ]);
        $path1 = $this->fileSubject->store('temp');
        $path=storage_path('app').'/'.$path1;
        Excel::import(new CurriculumImport($this->programId), $path);
    }

}
