<?php

namespace Modules\ArSys\Http\Livewire\Event\Admin\Common;

use Livewire\Component;
use Modules\ArSys\Entities\Event;
use Modules\ArSys\Entities\EventLetter;
class LetterNumber extends Component
{

    public $event;
    public $eventId;
    public $letterNumber = null;
    public $letterDate = null;
    public $programId;
    public $letterTypeId;
    public $listeners = ['eventAddLetterNumberComponent' => 'letterNumber',
                        'selectLetterType' => 'fillLetterType',
                        'selectEventSpaceSetting' => 'fillEventSpace',
                        'selectStudyProgram' => 'fillStudyProgram'];
    public function render()
    {
        return view('arsys::livewire.event.admin.common.letter-number');
    }

    public function fillStudyProgram($studyProgramId){
        $this->programId = $studyProgramId['studyProgramId'];
    }

    public function fillLetterType($letterTypeId){
        $this->letterTypeId = $letterTypeId['letterTypeId'];

    }

    public function fillEventSpace($spaceId){
        $this->letterTypeId = $spaceId['spaceId'];
    }

    public function letterNumber($event_id){
        $this->eventId = $event_id;
        $this->dispatchBrowserEvent('resetSelection',[]);
        $this->event = Event::where('id', $event_id)->first();
        $this->letterNumber = '';
        $this->letterDate = '';
        $this->programId = '';
        $this->letterTypeId = '';
        $this->emit('eventAddLetterNumberModal');
    }

    public function saveLetterNumber(){

        if($this->programId != null && $this->letterNumber != null && $this->letterDate != null){
            $letter = EventLetter::where('program_id', $this->programId)
                ->where('type_id', $this->letterTypeId)
                ->where('event_id', $this->eventId)->first();

            if($letter == null){
                EventLetter::create([
                    'program_id' => $this->programId,
                    'number' => $this->letterNumber,
                    'date' => $this->letterDate,
                    'event_id' => $this->eventId,
                    'type_id' => $this->letterTypeId,
                ]);
            }else{
                EventLetter::find($letter->id)->update([
                    'program_id' => $this->programId,
                    'number' => $this->letterNumber,
                    'date' => $this->letterDate,
                    'event_id' => $this->eventId,
                    'type_id' => $this->letterTypeId,
                ]);
            }
            $this->emit('successMessage', 'The letter number has been submitted');

        }
    }
    public function closeModal(){
        $this->emit('refreshSeminarApplicant');
    }
}
