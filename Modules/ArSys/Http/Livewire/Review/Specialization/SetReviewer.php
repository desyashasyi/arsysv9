<?php

namespace Modules\ArSys\Http\Livewire\Review\Specialization;

use Livewire\Component;
use Modules\ArSys\Entities\Faculty;
use Modules\ArSys\Entities\Research;
use Livewire\WithPagination;
use Modules\ArSys\Entities\ResearchReviewApproval;
use Auth;

class SetReviewer extends Component
{
    protected $listeners = ['emiterReviewSetReviewer' => 'setReviewer'];
    public $researchId = null;
    public $search;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {

        $research = Research::where('id', $this->researchId)->first();

        $faculties = Faculty::where('specialization_id', Auth::user()->faculty->specialization_id)
                    ->orderBy('code', 'ASC')
                    ->paginate(5);

        if ($this->search !== null) {
            $faculties = Faculty::where('first_name', 'like', '%' . $this->search . '%')
                ->orwhere('code', 'like', '%' . $this->search . '%')
                ->orderBy('code', 'ASC')
                ->paginate(5);
        }

        return view('arsys::livewire.review.specialization.set-reviewer', compact('faculties', 'research'));
    }

    public function setReviewer($id){
        $this->researchId = $id;
        $this->emit('reviewSetReviewerModal');
    }

    public function assign($research_id, $faculty_id){


        $approval = ResearchReviewApproval::where('research_id', $research_id)
            ->where('reviewer_id', $faculty_id)
            ->first();

        if($approval == null){
            ResearchReviewApproval::Create([
                'research_id' => $research_id,
                'reviewer_id' => $faculty_id,
            ]);
            if (ResearchReviewApproval::where('research_id', $research_id)->count() == 1){
                Research::find($research_id)->increment('research_milestone');
            }
        }


        $this->emit('refreshSpecializationReviewHome');
    }

    public function assignAllMember($research_id){

        $faculties = Faculty::where('specialization_id', Auth::user()->faculty->specialization_id)->get();
        foreach($faculties as $faculty){
            $approval = ResearchReviewApproval::where('research_id', $research_id)
            ->where('reviewer_id', $faculty->id)
            ->first();

            if($approval == null){
                ResearchReviewApproval::Create([
                    'research_id' => $research_id,
                    'reviewer_id' => $faculty->id,
                ]);
                if (ResearchReviewApproval::where('research_id', $research_id)->count() == 1){
                    Research::find($research_id)->increment('research_milestone');
                }
            }
        }

        $this->emit('refreshSpecializationReviewHome');
    }

    public function unAssign($research_id, $faculty_id){
        ResearchReviewApproval::where('research_id', $research_id)->where('reviewer_id', $faculty_id)
            ->delete();
        if (ResearchReviewApproval::where('research_id', $research_id)->count() == 0){
                Research::find($research_id)->decrement('research_milestone');
        }
        $this->emit('refreshSpecializationReviewHome');
    }
}
