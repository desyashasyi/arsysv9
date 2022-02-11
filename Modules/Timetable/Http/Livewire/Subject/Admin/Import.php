<?php

namespace Modules\Timetable\Http\Livewire\Subject\Admin;

use Livewire\Component;

use Livewire\WithFileUploads;
use Modules\Timetable\Imports\CurriculumImport;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Timetable\Entities\Subject;
use Modules\Timetable\Entities\SubjectYear;

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
        $subjects = Subject::where('program_id', $this->programId)->where('year_id', SubjectYear::latest()->first()->id)
                    ->get();

        if($subjects->isNotEmpty()){
            foreach($subjects as $subject){
                Subject::find($subject->id)->delete();
            }
        }
        Excel::import(new CurriculumImport($this->programId), $path);
    }

}
