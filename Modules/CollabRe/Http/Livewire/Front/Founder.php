<?php

namespace Modules\CollabRe\Http\Livewire\Front;

use Livewire\Component;
use Modules\CollabRe\Entities\Collabre;
use Modules\CollabRe\Entities\CollabreMember;
use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\Student;
use Auth;

class Founder extends Component
{
    public $editPageStatus = false;
    public $listeners = ['facultyCollabrePageRefresh' => '$refresh'];
    public $collabreName = null;
    public $collabreDescription = null;
    public $collabre;
    public $facultyId;

    public function mount(){
       
    }
    public function render()
    {
        $faculty = Faculty::where('id', Auth::user()->faculty->id)->first();
        $this->facultyId = $faculty->id;
        if(Collabre::where('founder_id', $faculty->id)->first() == null){
            Collabre::create([
                'founder_id' => $faculty->id,
                'description' => 'This is the initial page of CollabRe',
                'name' => $faculty->first_name.' '. $faculty->last_name.' Collaborative Page',
            ]);
        }
        $students = Student::
            whereHas('research', function($query){
                $query
                    ->whereHas('supervisor', function($query){
                        $query->where('supervisor_id', $this->facultyId);

                    })
                    ->whereHas('milestone', function($query){
                        $query->where(['milestone_model' => 'defense', 'status' => 1]);
                    })
                    ->where('username', null);
                })
            ->get();

        $this->collabre = Collabre::where('founder_id', $faculty->id)->first();
        $members = CollabreMember::where('collabre_id', $this->collabre->id)->get();

        if($members->isNotEmpty()){
            foreach($students as $student){
                foreach($members as $member){
                    if(!$students->contains('id', $member->student_id)){
                        if(CollabreMember::where('student_id',$member->student_id)->first() == null){
                            CollabreMember::create([
                                'status' => '1',
                                'student_id' => $student->id,
                                'collabre_id' => $this->collabre->id,
                            ]);
                        }else{
                            CollabreMember::where('student_id',$member->student_id)->update([
                                'status' => '0',
                            ]);
                        }
                    }
                }
            }
        }else{
            foreach($students as $student){
                CollabreMember::create([
                    'status' => '1',
                    'student_id' => $student->id,
                    'collabre_id' => $this->collabre->id,
                ]);
            }
        }
        $members = CollabreMember::where('collabre_id', $this->collabre->id)->get();
        return view('collabre::livewire.front.founder', compact('members'));
    }

    public function editPage(){
        $this->editPageStatus = true;
        $this->emit('facultyCollabrePageRefresh');
        $this->collabreName = $this->collabre->name;
        $this->collabreDescription = $this->collabre->description;
    }
    public function submitEditPage(){
        $this->editPageStatus = false;
        $this->emit('facultyCollabrePageRefresh');

        Collabre::where('founder_id', $this->facultyId)->update([
            'description' => $this->collabreDescription,
            'name' => $this->collabreName,
        ]);
    }

    public function todoList(){
        return redirect()->route('collabre.todo.directory', ['collabre_id' => $this->collabre->id]);
    }
}
