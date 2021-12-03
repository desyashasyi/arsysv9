<?php

namespace Modules\Office\Http\Livewire\Letter\Research\Clerk;

use Livewire\Component;
use Modules\Office\Entities\Research;
use Modules\Office\Entities\ResearchLetter;
use Modules\Office\Entities\ResearchLetterType;


class AddLetter extends Component
{
    protected $listeners = ['addResearchAssignmentLetter_Clerk' => 'addLetter'];
    public $researchId;
    public $research;
    public $letterDate;
    public $letterNumber;
    public function render()
    {
        if($this->researchId){
            $this->research = Research::where('id', $this->researchId)->first();
        }
        return view('office::livewire.letter.research.clerk.add-letter');
    }

    public function addLetter($research_id){
        $this->researchId = $research_id;
        $this->clearForm();
        $this->emit('addResearchAssignmentLetterModal_Clerk');
    }

    public function saveLetter(){
        $this->validate([
            'letterDate' => 'required',
            'letterNumber' => 'required',
        ]);

        $letter = ResearchLetter::where('research_id', $this->researchId)
                ->where('type_id', ResearchLetterType::where('code', 'SPV')->first()->id)->first();

        if($letter == null){
            ResearchLetter::create([
                'research_id' => $this->researchId,
                'number' => $this->letterNumber,
                'date' => $this->letterDate,
                'type_id' => ResearchLetterType::where('code', 'SPV')->first()->id,
            ]);
        }else{
            ResearchLetter::where('research_id', $this->researchId)
                ->where('type_id', ResearchLetterType::where('code', 'SPV')->first()->id)
                ->update([
                    'research_id' => $this->researchId,
                    'number' => $this->letterNumber,
                    'date' => $this->letterDate,
                    'type_id' => ResearchLetterType::where('code', 'SPV')->first()->id,
            ]);
        }
        session()->flash('success','The letter number has been submitted');
        $this->emitUp('refreshResearchAssignmentLetter_Clerk');
    }

    public function clearForm(){
        $this->resetErrorBag();
        $this->letterDate='';
        $this->letterNumber='';
    }

    public function close(){
        $this->clearForm();
        $this->emit('addResearchAssignmentLetterModal_Clerk');
    }
}
