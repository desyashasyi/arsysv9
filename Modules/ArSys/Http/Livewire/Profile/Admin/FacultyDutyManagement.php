<?php

namespace Modules\ArSys\Http\Livewire\Profile\Admin;

use Livewire\Component;
use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\FacultyDuty;
use Modules\ArSys\Entities\FacultyDutyType;
use Livewire\WithPagination;

class FacultyDutyManagement extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $faculty;
    public $facultyId;
    public $dutyTypes;
    public $listeners = ['refreshFacultyDutyManagement' => '$refresh'];
    public function render()
    {
        $faculties = Faculty::paginate(10);
        if($this->search != null){
            $faculties = Faculty::where('first_name','like', '%'.$this->search.'%')
            ->orderBy('first_name', 'ASC')
            ->paginate(10);
        }
        if($this->facultyId != null){
            $this->dutyTypes = FacultyDutyType::all();
            $this->faculty = Faculty::where('id', $this->facultyId)->first();
        }

        return view('arsys::livewire.profile.admin.faculty-duty-management', compact('faculties'));
    }

    public function addDuty($faculty_id){
        $this->facultyId = $faculty_id;
    }

    public function assignDuty($faculty_id, $type_id){
        $duty = FacultyDuty::where('faculty_id', $faculty_id)->where('type_id',$type_id)->first();
        if($duty == null){
            FacultyDuty::create([
                'type_id' => $type_id,
                'faculty_id' => $faculty_id,
            ]);
        }
        //$this->emit('refreshFacultyDutyManagement');
    }

    public function unAssignDuty($duty_id){
        FacultyDuty::where('id', $duty_id)->delete();
        //$this->emit('refreshFacultyDutyManagement');
    }

    public function close(){
        $this->faculty = null;
    }


}
