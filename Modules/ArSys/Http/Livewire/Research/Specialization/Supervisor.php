<?php

namespace Modules\ArSys\Http\Livewire\Research\Specialization;
use Livewire\Component;
use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\ResearchSupervisor;
use Modules\ArSys\Entities\ResearchSupervisorExternal;
use Livewire\WithPagination;

class Supervisor extends Component
{
    public $researchId = null;
    public $search;
    use WithPagination;
    public $externalInstitution;
    public $externalSupervisor;
    protected $paginationTheme = 'bootstrap';

    public $listeners = ['inProgressSetSupervisor_Specialization' => 'setSupervisor'];
    public function render()
    {
        $research = Research::where('id', $this->researchId)->first();

        $faculties = Faculty::orderBy('code', 'ASC')
                    ->paginate(5);

        if ($this->search !== null) {
            $faculties = Faculty::where('first_name', 'like', '%' . $this->search . '%')
                ->orwhere('code', 'like', '%' . $this->search . '%')
                ->orderBy('code', 'ASC')
                ->paginate(5);
        }

        return view('arsys::livewire.research.specialization.supervisor', compact('faculties', 'research'));
    }

    public function setSupervisor($id){
        $this->researchId = $id;
        $this->externalSupervisor = '';
        $this->externalSupervisor = '';
        $this->resetErrorBag();
        $this->emit('inProgressSetSupervisorModal');
    }

    public function assign($research_id, $faculty_id){


        //dd($supervisor->count());

        if(ResearchSupervisor::where('research_id', $research_id)->count()
            <  Research::where('id', $research_id)->first()->type->supervisor_number){


            if (ResearchSupervisor::where('research_id', $research_id)
                ->where('supervisor_id', $faculty_id)
                ->first() == null){
                    ResearchSupervisor::updateOrCreate([
                        'research_id' => $research_id,
                        'supervisor_id' => $faculty_id,
                    ]);
            }

        }
        $this->emit('refreshSpecializationInProgress');
    }

    public function unAssign($research_id, $faculty_id){
        if($faculty_id != Faculty::where('code', 'EXT')->first()->id){
            ResearchSupervisor::where('research_id', $research_id)->where('supervisor_id', $faculty_id)
            ->delete();
        }else{
            ResearchSupervisor::where('research_id', $research_id)->where('supervisor_id', $faculty_id)
            ->delete();
            ResearchSupervisorExternal::where('research_id', $research_id)->delete();
        }
        
        $this->emit('refreshSpecializationInProgress');
    }


    public function assignExternalSupervisor(){
        $this->validate([
            'externalSupervisor' => 'required',
            'externalInstitution' => 'required',
        ]);

        $research = ResearchSupervisorExternal::where('research_id', $this->researchId)->first();
        if($research == null){
            ResearchSupervisorExternal::create([
                'research_id' => $this->researchId,
                'supervisor_name' => $this->externalSupervisor,
                'institution' => $this->externalInstitution,
            ]);
        }else{
            ResearchSupervisorExternal::where('research_id', $this->researchId)->update([
                'research_id' => $this->researchId,
                'supervisor_name' => $this->externalSupervisor,
                'institution' => $this->externalInstitution,
            ]);
        }
        $this->externalSupervisor = '';
        $this->externalSupervisor = '';

        $this->emit('refreshSpecializationInProgress');
    }
}
