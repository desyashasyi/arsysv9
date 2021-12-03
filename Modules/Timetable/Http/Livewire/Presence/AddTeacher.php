<?php

namespace Modules\Timetable\Http\Livewire\Presence;

use Livewire\Component;
use Livewire\WithPagination;


use Modules\Timetable\Entities\Faculty;
use Modules\Timetable\Entities\LecturesTeacher;
use Modules\Timetable\Entities\Lectures;

class AddTeacher extends Component
{

    public $searchFaculty;
    use WithPagination;
    public $lectureId;
    public $lecture;
    protected $paginationTheme = 'bootstrap';


    public $listeners = ['addTeacherComponent' => 'addTeacher'];

    public function mount(){
        $this->searchfaculty = null;
        $this->lectureId = '';
        $this->lecture ='';
    }

    public function render()
    {
        $faculties = Faculty::orderBy('code', 'ASC')
                    ->paginate(5);

        if ($this->searchFaculty !== null) {
            $faculties = Faculty::where('first_name', 'like', '%' . $this->searchFaculty . '%')
                ->orwhere('code', 'like', '%' . $this->searchFaculty . '%')
                ->orderBy('code', 'ASC')
                ->paginate(5);
        }
        $this->lecture = Lectures::where('id', $this->lectureId)->first();
        return view('timetable::livewire.presence.add-teacher', compact ('faculties'));
    }

    public function addTeacher($id){
        $this->searchFaculty = '';
        
        $this->lectureId = $id;
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('hideAll');
        $this->emit('addTeacherModal');
    }

    public function assignTeacher($faculty_id){

        $checkTeacher = LecturesTeacher::where('lecture_id', $this->lectureId)->where('faculty_id', $faculty_id)->first();
        if($checkTeacher === null){
            LecturesTeacher::create([
                'lecture_id' => $this->lectureId,
                'faculty_id' => $faculty_id,
            ]);
        }
    }

    public function removeTeacher($id){
        LecturesTeacher::where('id', $id )->delete();
    }
}
