<?php

namespace Modules\Timetable\Http\Livewire\Subject\Admin;

use Livewire\Component;
use Modules\Timetable\Entities\Subject;
use Livewire\WithPagination;

class Home extends Component
{
    public $programId;
    public $semester;
    public $orderBy;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $listeners = ['selectStudyProgram' => 'fillProgram'];

    public function fillProgram($studyProgramId){
        $this->programId = $studyProgramId['studyProgramId'];
    }
    public function render()
    {
        $subjects = null;
        $subject = null;
        if($this->programId){
            if($this->orderBy){
                $subjects = Subject::where('program_id',$this->programId)
                    ->orderBy($this->orderBy, 'ASC')->paginate(50);
            }else{
                $subjects = Subject::where('program_id',$this->programId)->paginate(50);
            }
            $subject = Subject::where('program_id',$this->programId)->first();
        }
        return view('timetable::livewire.subject.admin.home', compact('subjects', 'subject'));
    }

    public function sort($order_By){
        $this->orderBy = $order_By;
    }

    public function semesterAll(){
        $this->semester = null;
    }

    public function semesterOdd(){
        $this->semester = 'Odd';
    }

    public function semesterEvent(){
        $this->semester = 'Even';
    }
}
