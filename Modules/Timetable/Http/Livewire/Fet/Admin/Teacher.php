<?php

namespace Modules\Timetable\Http\Livewire\Fet\Admin;

use Livewire\Component;
use Modules\Timetable\Entities\FetTeacher;
use Modules\Timetable\Entities\Faculty;
use Livewire\WithPagination;

class Teacher extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $listeners = ['fetTeachersData' => 'teacherData'];
    public $searchFaculty;
    public $searchTeacher;
    public function render()
    {
        $teachers = FetTeacher::orderBy('id', 'ASC')->get();
        if ($this->searchTeacher !== null) {

            $teachers = FetTeacher::whereHas('faculty', function($query){
                    $query->where('first_name', 'like', '%' . $this->searchTeacher . '%')
                    ->orWhere('code', 'like', '%' . $this->searchTeacher . '%');
                })
                ->get();

        }
        $faculties = Faculty::orderBy('code', 'ASC')->paginate(8);
        if ($this->searchFaculty !== null) {

            $faculties = Faculty::where('first_name', 'like', '%' . $this->searchFaculty . '%')
                ->orWhere('code', 'like', '%' . $this->searchFaculty . '%')
                ->paginate(8);
                $this->resetPage();
        }
        return view('timetable::livewire.fet.admin.teacher', compact('teachers', 'faculties'));
    }

    public function teacherData(){
        $this->emit('fetTeachersDataModal');
    }
    public function close(){

    }

    public function assignTeacher($faculty_id){
        $teacherCheck = FetTeacher:: where('teacher_id', $faculty_id)->first();
        if($teacherCheck == null){
            FetTeacher::create([
                'teacher_id' => $faculty_id,
                'program_id' => Faculty::where('id', $faculty_id)->first()->program_id,
            ]);
        }else{
            FetTeacher::where('teacher_id', $faculty_id)->update([
                'teacher_id' => $faculty_id,
                'program_id' => Faculty::where('id', $faculty_id)->first()->program_id,
            ]);
        }
    }
    public function unAssignTeacher($teacher_id){
        FetTeacher::find($teacher_id)->delete();
    }
}
