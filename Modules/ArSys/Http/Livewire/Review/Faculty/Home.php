<?php

namespace Modules\ArSys\Http\Livewire\Review\Faculty;

use Livewire\Component;


use Auth;
use Modules\ArSys\Entities\Student;
use Modules\ArSys\Entities\ResearchReview;
use Modules\ArSys\Entities\ResearchReviewHistory;
use Modules\ArSys\Entities\ResearchDecisionType;
use Carbon\carbon;
use Livewire\WithPagination;


class Home extends Component
{
    public $search;
    public $comments = [];
    public $iterator = 1;
    public $finalRemark;
    public $researchId;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refreshResearchIndex' => '$refresh',
        'submitProposalReviewFaculty' => 'submitReview',

    ];
    public function render()
    {

        $user = Auth::user();
        $students = Student::whereHas('research', function($query) use ($user){
                        $query
                            ->whereHas('proposalReview', function($query) use ($user){
                                return $query->where('reviewer_id', $user->faculty->id);
                            })
                            ->Where('research_milestone',3);
                    })
                    ->orderBy('first_name', 'ASC')
                    ->paginate(10);


        if ($this->search !== null) {
            $students = Student::where('specialization_id', $user->faculty->specialization_id)
                    ->whereHas('research', function($query) {
                        $query->orwhere('research_milestone', 3);
                    })
                    ->where('first_name', 'like', '%' . $this->search . '%')
                    ->orderBy('first_name', 'ASC')
                    ->paginate(10);
        }


        return view('arsys::livewire.review.faculty.home', compact('students'));
    }

    public function submitRemark($id){
        $this->researchId = $id;
        $this->emit('submitReviewFacultyRemarkModal');
    }

    public function decision($id, $decision){
        $user = Auth::user();

        ResearchReview::where(['research_id' => $id, 'reviewer_id' => $user->faculty->id])->update([
            'decision_id' => ResearchDecisionType::where('code', $decision)->first()->id,
            'approval_date' => Carbon::now(),
        ]);

    }

    public function submitFinalRemark(){
        $user = Auth::user();
        $this->validate([
            'finalRemark' => 'required',
        ]);
        ResearchReview::where(['research_id' => $this->researchId, 'reviewer_id' => $user->faculty->id])->update([
            'comment' => $this->finalRemark,
        ]);
    }


}

