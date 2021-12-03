<?php

namespace Modules\ArSys\Http\Livewire\Review\Faculty;

use Livewire\Component;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\ResearchReviewDiscussion;
use Modules\ArSys\Entities\ResearchReviewDiscussionRead;
use Auth;
class Discussion extends Component
{
    public $researchId;
    public $comment;
    protected $listeners = ['proposalReviewDiscussionComponent' => 'proposalReviewDiscussion',
                            'deleteReviewDiscussionMessage_faculty' => 'deleteReviewDiscussionMessage'];


    public function render()
    {
        $research = Research::where('id', $this->researchId)->first();
        return view('arsys::livewire.review.faculty.discussion', compact('research'));
    }

    public function proposalReviewDiscussion($research_id){
        $this->researchId = $research_id;
        $this->resetErrorBag();
        $this->comment = '';
        $this->emit('submitReviewFacultyDiscussionModal');
    }

    public function submitComment(){
        $this->validate([
            'comment' => 'required',
        ]);

        ResearchReviewDiscussion::create([
            'message' => $this->comment,
            'research_id' => $this->researchId,
            'discussant_id' => Auth::user()->faculty->id,
            'discussant_type' => 1,
        ]);

        $research = Research::where('id', $this->researchId)->first();

        foreach($research->proposalReview as $reviewer){
            if($reviewer->reviewer_id != Auth::user()->faculty->id){
                ResearchReviewDiscussionRead::create([
                    'reader_id' => $reviewer->reviewer_id,
                    'research_id' => $this->researchId,
                ]);
            }
        }
        ResearchReviewDiscussionRead::create([
            'reader_id' => $research->student->id,
            'research_id' => $this->researchId,
        ]);

        $this->resetErrorBag();
        $this->comment = '';
        session()->flash('success', 'The discussion message has been submitted');
        $this->emit('refreshResearchIndex');
    }

    public function deleteReviewDiscussionMessage($id){
        ResearchReviewDiscussion::where('id', $id)->delete();
        $this->emit('refreshResearchIndex');
    }
}
