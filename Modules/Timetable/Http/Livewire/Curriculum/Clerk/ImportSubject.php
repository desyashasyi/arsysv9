<?php

namespace Modules\Timetable\Http\Livewire\Curriculum\Clerk;

use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Timetable\Imports\SubjectImport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
class ImportSubject extends Component
{
    public $programId;
    public $fileSubject;
    use WithFileUploads;
    protected $listeners = ['clerkImportSubjectComponent' => 'importSubject'];
    public function render()
    {
        return view('timetable::livewire.curriculum.clerk.import-subject');
    }

    public function importSubject(){

        $this->programId = Auth::user()->faculty->program_id;

        $this->emit('importSubjectModal');
    }

    public function closeModal(){

    }

    public function submitSubject(){
        $this->validate([
            'fileSubject' => "required|max:10000",
        ]);
        $path1 = $this->fileSubject->store('temp');
        $path=storage_path('app').'/'.$path1;
        Excel::import(new SubjectImport($this->programId), $path);
    }
}
