<?php

namespace Modules\Timetable\Http\Livewire\Presence;

use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Timetable\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithPagination;

use Modules\Timetable\Entities\Lectures;
use Modules\Timetable\Entities\LecturesStudent;

class ImportStudent extends Component
{

    public $lectureId;
    public $fileStudent;
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $listeners = ['importStudentComponent' => 'importStudent'];

    public function mount(){
        $this->lectureId = '';
        $this->file = '';
    }

    public function render()
    {
        $lecture= Lectures::where('id', $this->lectureId)->first();
        $students = LecturesStudent::where('lecture_id', $this->lectureId)
            ->orderBy('student_number', 'ASC')->paginate(5);
        return view('timetable::livewire.presence.import-student', compact('lecture', 'students'));
    }

    public function importStudent($id){
        $this->fileStudent = '';
        $this->lectureId = $id;
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('hideAll');
        $this->emit('importStudentModal');
    }

    public function submitStudents(){
        
        $this->validate([
            'fileStudent' => "required|max:10000",
        ]);
        $path1 = $this->fileStudent->store('temp');
        $path=storage_path('app').'/'.$path1;  
        Excel::import(new StudentImport($this->lectureId), $path);
    }
    
}
