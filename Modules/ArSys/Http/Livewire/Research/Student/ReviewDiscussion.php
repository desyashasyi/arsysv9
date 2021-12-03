<?php

namespace Modules\ArSys\Http\Livewire\Research\Student;

use Livewire\Component;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\ResearchReviewDiscussion;
use Modules\ArSys\Entities\ResearchReviewDiscussionRead;
use Auth;

class ReviewDiscussion extends Component
{
    public $researchId;
    public $comment;
    protected $listeners = ['reviewDiscussion_Student' => 'proposalReviewDiscussion',
                            'deleteReviewDiscussionMessage_Student' => 'deleteReviewDiscussionMessage'];
    public function render()
    {
        $research = Research::where('id', $this->researchId)->first();
        return view('arsys::livewire.research.student.review-discussion',compact('research'));
    }

    public function proposalReviewDiscussion($research_id){
        $this->researchId = $research_id;
        $this->resetErrorBag();
        $this->emit('reviewDiscussionModal_Student');
    }

    public function submitComment(){
        $this->validate([
            'comment' => 'required',
        ]);

        ResearchReviewDiscussion::create([
            'message' => $this->comment,
            'research_id' => $this->researchId,
            'discussant_id' => Auth::user()->student->id,
            'discussant_type' => 2,
        ]);

        $research = Research::where('id', $this->researchId)->first();

        foreach($research->proposalReview as $reviewer){
            ResearchReviewDiscussionRead::create([
                'reader_id' => $reviewer->reviewer_id,
                'research_id' => $this->researchId,
            ]);
        }

        session()->flash('success', 'The discussion message has been submitted');
        $this->emit('refreshStudentResearchPage');
    }

    public function deleteReviewDiscussionMessage($id){
        ResearchReviewDiscussion::where('id', $id)->delete();
        $this->emit('refreshResearchIndex');
    }
}



