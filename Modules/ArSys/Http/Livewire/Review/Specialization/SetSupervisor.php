<?php

namespace Modules\ArSys\Http\Livewire\Review\Specialization;

use Livewire\Component;
use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\ResearchSupervisorDummy;
use Livewire\WithPagination;

class SetSupervisor extends Component
{
    protected $listeners = ['emiterReviewSetSupervisor' => 'setSupervisor'];
    public $researchId = null;
    public $search;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
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

        return view('arsys::livewire.review.specialization.set-supervisor', compact('faculties', 'research'));
    }

    public function setSupervisor($id){
        $this->researchId = $id;
        $this->emit('reviewSetSupervisorModal');
    }

    public function assign($research_id, $faculty_id){


        //dd($supervisor->count());

        if(ResearchSupervisorDummy::where('research_id', $research_id)->count()
            <  Research::where('id', $research_id)->first()->type->supervisor_number){


            if (ResearchSupervisorDummy::where('research_id', $research_id)
                ->where('supervisor_id', $faculty_id)
                ->first() == null){
                    ResearchSupervisorDummy::updateOrCreate([
                        'research_id' => $research_id,
                        'supervisor_id' => $faculty_id,
                    ]);
            }

        }
        $this->emit('refreshSpecializationReviewHome');
    }

    public function unAssign($research_id, $faculty_id){
        ResearchSupervisorDummy::where('research_id', $research_id)->where('supervisor_id', $faculty_id)
            ->delete();
        $this->emit('refreshSpecializationReviewHome');
    }
}
