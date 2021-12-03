<?php

namespace Modules\ArSys\Http\Livewire\Event\Admin;

use Livewire\Component;
use Modules\ArSys\Entities\EventApplicant;
use Livewire\WithPagination;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\Event;
use Modules\ArSys\Entities\EventLetter;
use Modules\ArSys\Entities\SeminarRoom;
use Modules\ArSys\Entities\SeminarParticipant;
use App\Models\User;
use Carbon\Carbon;
use PDF;


class FinalDefenseApplicant extends Component
{
    public $eventId;
    public $searchExaminer;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sortingData = false;
    public $publishState = false;
    public $letterNumber = null;
    public $letterDate = null;
    public $research = null;
    public $programId = null;

    protected $listeners = ['refreshFinalDefenseApplicant' => '$refresh',
                            'selectStudyProgram' => 'fillStudyProgram'];

    public function mount($event_id){
        $this->eventId = $event_id;
    }
    public function render()
    {

        $faculties = Faculty::orderBy('code', 'ASC')->paginate(5);
        $rooms = SeminarRoom::where('event_id', $this->eventId)->get();
        $event = Event::where('id', $this->eventId)->first();
        if ($this->searchExaminer !== null) {
            $faculties = Faculty::where('first_name', 'like', '%' . $this->searchExaminer . '%')
                ->orWhere('code', 'like', '%' . $this->searchExaminer . '%')
                ->paginate(5);
        }

        if($this->sortingData){
            $applicants = EventApplicant::where('event_id', $this->eventId)
                ->orderBy('session_id', 'ASC')
                ->paginate(5);
        }else{
            $applicants = EventApplicant::where('event_id', $this->eventId)
            ->paginate(5);
        }

        return view('arsys::livewire.event.admin.final-defense-applicant',compact('applicants', 'event', 'faculties','rooms'));
    }

    public function publish(){
        $event = Event::where('id', $this->eventId)->first();
        if($event->letter != null){
            if($event->status != 1){
                $applicants = EventApplicant::where('event_id', $this->eventId)->get();
                foreach($applicants as $applicant){
                    Research::find($applicant->research_id)->increment('research_milestone');
                }
                Event::where('id', $this->eventId)->update(['status' => 1]);
            }
        }
    }

    public function publishDocx(){


        $applicants = EventApplicant::where('event_id', $this->eventId)->get();
        foreach($applicants as $applicant){
            Research::find($applicant->research_id)->increment('research_milestone');
        }
        Event::where('id', $this->eventId)->update(['status' => 1]);
        $event = Event::where('id', $this->eventId)->first();

        if($event->letter_number != null)
            return redirect()->route('neoarsys.print.admin.print-defense-assignment-docx',[$this->eventId]);
    }


    public function addLetterNumber(){
        $this->dispatchBrowserEvent('resetSelection',[]);
        $event = Event::where('id', $this->eventId)->first();
        $this->letterNumber = '';
        $this->letterDate = '';
        $this->programId = '';
        $this->emit('eventFacultyApplicantAddLetterNumberModal');
    }
    public function sortUpApplicant(){
        $this->sortingData = true;
    }

    public function fillStudyProgram($studyProgramId){
        $this->programId = $studyProgramId['studyProgramId'];
    }

    public function saveLetterNumber(){

        if($this->programId != null && $this->letterNumber != null && $this->letterDate != null){
            $letter = EventLetter::where('program_id', $this->programId)
            ->where('event_id', $this->eventId)->first();

            if($letter == null){
                EventLetter::create([
                    'program_id' => $this->programId,
                    'number' => $this->letterNumber,
                    'date' => $this->letterDate,
                    'event_id' => $this->eventId,
                ]);
            }else{
                EventLetter::find($letter->id)->update([
                    'program_id' => $this->programId,
                    'number' => $this->letterNumber,
                    'date' => $this->letterDate,
                    'event_id' => $this->eventId,
                ]);
            }
        }
    }
    public function selectRoom($applicant_id, $room_id){
        EventApplicant::where('id', $applicant_id)->update([
            'room_id' => $room_id,
        ]);
    }
}
