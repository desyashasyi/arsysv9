<?php

namespace Modules\ArSys\Http\Livewire\Event\Admin\Seminar;
use Livewire\Component;
use Modules\ArSys\Entities\EventApplicant;
use Modules\ArSys\Entities\EventApplicantWaiting;
use Livewire\WithPagination;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\Event;
use Modules\ArSys\Entities\EventLetter;
use Modules\ArSys\Entities\EventLetterType;
use Modules\ArSys\Entities\SeminarRoom;
use Modules\ArSys\Entities\SeminarParticipant;
use Modules\ArSys\Entities\SeminarExaminer;
use Modules\ArSys\Entities\SeminarModerator;
use App\Models\User;
use Carbon\Carbon;
use PDF;

class Applicant extends Component
{
    public $eventId;
    public $sortingData;
    public $scheduled;
    public $registeredParticipants;
    public $addWaitingApplicantForm;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshSeminarApplicant' => '$refresh'];
    public function mount($event_id){
        $this->eventId = $event_id;
    }
    public function render()
    {

        $faculties = Faculty::orderBy('code', 'ASC')->paginate(5);
        $rooms = SeminarRoom::where('event_id', $this->eventId)->paginate(1);
        $event = Event::where('id', $this->eventId)->first();

        $applicants = null;
        $waitingApplicant = null;
        if($this->sortingData){
            $applicants = EventApplicant::where('event_id', $this->eventId)
                ->orderBy('session_id', 'ASC')
                ->paginate(5);
            $waitingApplicant = EventApplicantWaiting::where('event_id', $this->eventId)
                ->orderBy('session_id', 'ASC')
                ->get();

            $applicantsCount = EventApplicant::where('event_id', $this->eventId)
            ->orderBy('session_id', 'ASC')
            ->get();
            $this->registeredParticipants = $applicantsCount->count();
        }else{
            $applicants = EventApplicant::where('event_id', $this->eventId)
            ->paginate(5);
            $waitingApplicant = EventApplicantWaiting::where('event_id', $this->eventId)
                ->orderBy('session_id', 'ASC')
                ->get();

            $applicantsCount = EventApplicant::where('event_id', $this->eventId)
            ->get();
            $this->registeredParticipants = $applicantsCount->count();
        }


        return view('arsys::livewire.event.admin.seminar.applicant', compact('applicants', 'event', 'rooms','waitingApplicant'));
    }


    public function selectRoom($applicant_id, $room_id){
        EventApplicant::where('id', $applicant_id)->update([
            'room_id' => $room_id,
        ]);
    }

    public function addLetterNumber(){

    }
    public function sortUpApplicant(){
        $this->sortingData = true;
    }

    public function deleteLetter($letter_id){
        EventLetter::find($letter_id)->delete();
    }

    public function printYudiciumLetter($program_id, $letter_type){
        return redirect()->route('arsys.event.admin.print-yudicium-letter',[$this->eventId, $program_id, $letter_type]);
    }

    public function publish(){
        $event = Event::where('id', $this->eventId)->first();
        if($event->letter != null){
            if($event->letter->contains('type_id', EventLetterType::where('code', 'DEFASS')->first()->id)){
                if($event->status != 1){
                    $applicants = EventApplicant::where('event_id', $this->eventId)->get();
                    foreach($applicants as $applicant){
                        Research::find($applicant->research_id)->increment('research_milestone');
                    }
                    Event::where('id', $this->eventId)->update(['status' => 1]);
                    $this->emit('successMessage', 'The defense schedule has been published');
                }
            }else{
                $this->emit('errorMessage', 'You should submit the number of defense assignment letter');
            }
        }
    }

    public function unAssignModerator($moderator_id){
        SeminarModerator::where('id', $moderator_id)->delete();
    }
    public function unAssignExaminer($examiner_id){
        SeminarExaminer::where('id', $examiner_id)->delete();
    }

    public function unAssignApplicant($applicant_id){
        EventApplicant::where('id', $applicant_id)->update([
            'room_id' => NULL,
            'session_id' => NULL,
            'space_id' => NULL,
        ]);
    }

    public function scheduleCompleted(){
        $applicants = EventApplicant::where('event_id', $this->eventId)->get();
        foreach($applicants as $applicant){
            if($applicant->research->milestone->milestone_model = 'defense'){
                Research::where('id', $applicant->research_id)->increment('research_milestone');
                Research::where('id', $applicant->research_id)->increment('research_milestone');
                Research::where('id', $applicant->research_id)->increment('research_milestone');
                $this->emit('successMessage', 'All participants has been set to graduated');
            }
        }
    }
    public function addWaitingApplicant(){
        if($this->addWaitingApplicantForm)
            $this->addWaitingApplicantForm = false;
        else
            $this->addWaitingApplicantForm = true;

        $this->resetPage();
    }

    public function fixingApplicant($waiting_id){
        $waiting = EventApplicantWaiting::where('id', $waiting_id)->first();
        $applicant = EventApplicant::where('event_id',$this->eventId)
            ->where('research_id', $waiting->research_id)->first();
        if($waiting != null){
            if($applicant == null){
                EventApplicant::create([
                    'event_id' => $this->eventId,
                    'research_id' => $waiting->research_id,
                    'event_type' => $waiting->event_type,
                ]);

            }
            EventApplicantWaiting::where('id',$waiting_id)->delete();
            $this->emit('refreshSeminarApplicant');
        }

    }

    
}
