<?php

namespace Modules\ArSys\Http\Livewire\Defense\Faculty;

use Livewire\Component;
use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\EventApplicant;
use Modules\ArSys\Entities\Event;
use Modules\ArSys\Entities\EventType;
use Modules\ArSys\Entities\DefenseExaminer;
use Livewire\WithPagination;

class AddExaminer extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $applicant;
    public $searchExaminer;
    public $eventId;
    public $applicantId;
    public $showModal = false;
    protected $listeners = ['defenseFacultyAddExaminer' => 'addExaminer'];
    public function render()
    {
        $faculties = Faculty::orderBy('code', 'ASC')->paginate(5);
        if ($this->searchExaminer !== null) {

            $faculties = Faculty::where('first_name', 'like', '%' . $this->searchExaminer . '%')
                ->orWhere('code', 'like', '%' . $this->searchExaminer . '%')
                ->paginate(5);
        }
        if($this->showModal == true){
            $this->applicant = EventApplicant::where('id', $this->applicantId)->first();
            $this->eventId = $this->applicant->event_id;
        }
        return view('arsys::livewire.defense.faculty.add-examiner', compact('faculties'));
    }

    public function addExaminer($id){
        $this->applicantId = $id;
        $this->showModal = true;
        $this->emit('defenseFacultyAddExaminerModal');
    }

    public function closeModal(){
        $this->showModal = false;
        $this->emit('refreshEventFacultyUpcoming');
    }

    public function assignExaminer( $facultyId){


        $event_type = Event::where('id', $this->eventId)->first()->event_type;
        if($event_type == EventType::where('abbrev', 'PRE')->first()->id){
            $applicant = EventApplicant::where('id', $this->applicantId)->first();

            if($applicant != null){
                if(!$applicant->research->supervisor->contains('supervisor_id', $facultyId)){
                    $examiner = DefenseExaminer::where('examiner_id', $facultyId)->where('applicant_id', $this->applicantId)->first();
                    if($examiner == null){
                        $examiners = DefenseExaminer::where('applicant_id', $this->applicantId)
                        ->where('event_id', $this->eventId)->get();
                        DefenseExaminer::create([
                            'applicant_id' => $this->applicantId,
                            'examiner_id' => $facultyId,
                            'event_id' => $this->eventId,
                            'addition' => true,
                        ]);
                        //$this->emit('successMessage', 'The faculty member has been added as an examiner');
                    }
                }
            }
        }
    }

    public function unAssignExaminer($examinerId){
        $this->emit('removeExaminer', $examinerId);
    }

    public function removeExaminer($examiner_id){
        $examiner = DefenseExaminer::where('id', $examiner_id)->first();
        if($examiner->presence != null){
            $examiner->presence->delete();
        }
        DefenseExaminer::where('id', $examiner_id)->where('applicant_id', $this->applicantId)->delete();
    }
}
