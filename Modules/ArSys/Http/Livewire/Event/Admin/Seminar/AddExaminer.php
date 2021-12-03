<?php

namespace Modules\ArSys\Http\Livewire\Event\Admin\Seminar;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\SeminarRoom;
use Modules\ArSys\Entities\SeminarExaminer;
use Modules\ArSys\Entities\EventApplicant;

class AddExaminer extends Component
{
    public $eventId;
    public $roomId;
    public $searchExaminer;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['seminarExaminerComponent' => 'addExaminer'];
    public function render()
    {
        $room = null;
        $faculties = null;
        $applicants = null;
        if($this->roomId != null){
            $room = SeminarRoom::where('id', $this->roomId)->first();
            $this->eventId = $room->event_id;

            $applicants = EventApplicant::where('event_id', $this->eventId)->get();
            $faculties = Faculty::orderBy('code', 'ASC')->paginate(5);

            if ($this->searchExaminer !== null) {

                $faculties = Faculty::where('first_name', 'like', '%' . $this->searchExaminer . '%')
                    ->orWhere('code', 'like', '%' . $this->searchExaminer . '%')
                    ->paginate(5);
            }
        }

        return view('arsys::livewire.event.admin.seminar.add-examiner', compact('faculties', 'room', 'applicants'));
    }
    public function addExaminer($room_id){
        $this->roomId = $room_id;
        $this->emit('adminSeminarExaminerModal');
    }
    public function closeModal(){
        $this->emit('refreshSeminarApplicant');
    }

    public function assignExaminer($faculty_id){
        $examiner = SeminarExaminer::where('examiner_id', $faculty_id)
                ->where('room_id', $this->roomId)->first();

        if($examiner == null){
            SeminarExaminer::create([
                'room_id' => $this->roomId,
                'examiner_id' => $faculty_id,
            ]);
        }else{
            SeminarExaminer::where('id', $examiner->id)->update([
                'room_id' => $this->roomId,
            ]);
        }
    }

    public function unAssignExaminer($examiner_id){
        SeminarExaminer::where('id', $examiner_id)->delete();
    }


}
