<?php

namespace Modules\ArSys\Http\Livewire\Event\Admin;

use Livewire\Component;
use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\FacultyDutyType;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\EventApplicant;
use Modules\ArSys\Entities\Event;
use Modules\ArSys\Entities\EventType;
use Modules\ArSys\Entities\DefenseExaminer;
use Livewire\WithPagination;

class DefenseSetting extends Component
{
    public $applicant;
    public $applicantId;
    public $eventId;
    public $sessionId = null;
    public $spaceId = null;
    public $searchExaminer;
    public $assignedExaminer;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['emiterEventAdminDefenseSetting' => 'defenseSetting',
                            'selectEventSessionSetting' => 'sessionEventSetting',
                            'selectEventSpaceSetting' => 'spaceEventSetting',
                            ];

    public function render()
    {
        $faculties = Faculty::whereHas('duty',function($query){
                $query->where('duty_id',5);
            })
            ->orderBy('code', 'ASC')->paginate(5);
        if($this->applicantId != null){
            $this->applicant = EventApplicant::where('id',$this->applicantId)->first();
            $this->eventId = $this->applicant->event_id;

            /*$this->assignedExaminer = EventApplicant::where('event_id', $this->eventId)
                        ->where('session_id', $this->applicant->session_id)->get();
                        dd($this->assignedExaminer);
            */
        }


        if ($this->searchExaminer !== null) {

            $faculties = Faculty::whereHas('duty',function($query){
                    $query->where('duty_id',5);
                })
                ->where('first_name', 'like', '%' . $this->searchExaminer . '%')
                ->orWhere('code', 'like', '%' . $this->searchExaminer . '%')
                ->paginate(5);
        }
        return view('arsys::livewire.event.admin.defense-setting', compact('faculties'));
    }

    public function defenseSetting($id){

        $this->searchExaminer = '';
        $this->applicantId = $id;

        $this->dispatchBrowserEvent('resetSession',[]);
        $this->dispatchBrowserEvent('resetSpace',[]);
        $this->emit('adminApplicantDefenseSettingModal');
    }

    public function sessionEventSetting($sessionId)
    {
        $this->sessionId = $sessionId['sessionId'];
        EventApplicant::find($this->applicantId)->update([
            'session_id' => $this->sessionId,
        ]);

    }

    public function spaceEventSetting($spaceId)
    {
        $this->spaceId = $spaceId['spaceId'];
        EventApplicant::find($this->applicantId)->update([
            'space_id' => $this->spaceId,
        ]);
    }

    public function assignExaminer( $facultyId){
        $event_type = Event::where('id', $this->eventId)->first()->event_type;
        if($event_type == EventType::where('abbrev', 'PRE')->first()->id){
            $applicant = EventApplicant::where('id', $this->applicantId)->first();
            if($applicant != null){
                if(!$applicant->research->supervisor->contains('supervisor_id', $facultyId)){
                    $examiner = DefenseExaminer::where('examiner_id', $facultyId)->where('applicant_id', $this->applicantId)->first();
                    if($examiner != null){
                        $examiner->update([
                            'applicant_id' => $this->applicantId,
                            'examiner_id' => $facultyId,
                            'event_id' => $this->eventId,
                        ]);
                    }else{
                        $examiners = DefenseExaminer::where('applicant_id', $this->applicantId)
                        ->where('event_id', $this->eventId)->get();
                        if( $examiners->count() < 3){
                            DefenseExaminer::create([
                                'applicant_id' => $this->applicantId,
                                'examiner_id' => $facultyId,
                                'event_id' => $this->eventId,
                            ]);
                        }
                    }
                    session()->flash('success', 'examiner has been assigned');
                }
            }
        }
    }

    public function unAssignExaminer( $examinerId){
        $examiner = DefenseExaminer::where('id', $examinerId)->where('applicant_id', $this->applicantId)->delete();
    }

    public function closeModal(){
        $this->emit('refreshAdminEventApplicant');
    }


}
