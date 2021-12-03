<?php

namespace Modules\ArSys\Http\Livewire\Review\Specialization;

use Livewire\Component;
use Modules\ArSys\Entities\ResearchSupervisorExternalDummy;

class SetSupervisorExternal extends Component
{
    public $researchId;
    public $externalInstitution;
    public $externalSupervisor;
    protected $listeners = ['emiterReviewSetExternalSupervisor' => 'setExternalSupervisor'];
    public function render()
    {
        return view('arsys::livewire.review.specialization.set-supervisor-external');
    }

    public function setExternalSupervisor($id){
        $this->researchId = $id;
        $this->emit('reviewSetExternalSupervisorModal');
    }

    public function assignExternalSupervisor(){
        $this->validate([
            'externalSupervisor' => 'required',
            'externalInstitution' => 'required',
        ]);

        $research = ResearchSupervisorExternalDummy::where('research_id', $this->researchId)->first();
        if($research == null){
            ResearchSupervisorExternalDummy::create([
                'research_id' => $this->researchId,
                'supervisor_name' => $this->externalSupervisor,
                'institution' => $this->externalInstitution,
            ]);
        }else{
            ResearchSupervisorExternalDummy::where('research_id', $this->researchId)->update([
                'research_id' => $this->researchId,
                'supervisor_name' => $this->externalSupervisor,
                'institution' => $this->externalInstitution,
            ]);
        }
        $this->emit('refreshSpecializationReviewHome');
    }
}
