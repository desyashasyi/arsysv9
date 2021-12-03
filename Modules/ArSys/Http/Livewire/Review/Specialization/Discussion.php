<?php

namespace Modules\ArSys\Http\Livewire\Review\Specialization;

use Livewire\Component;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\ResearchReviewDiscussion;
use Modules\ArSys\Entities\ResearchReviewDiscussionRead;

class Discussion extends Component
{
    public $researchId;
    protected $listeners = ['reviewDiscussion_Specialization' => 'proposalReviewDiscussion'];
    public function render()
    {
        $research = Research::where('id', $this->researchId)->first();
        return view('arsys::livewire.review.specialization.discussion', compact('research'));
    }

    public function proposalReviewDiscussion($research_id){
        $this->researchId = $research_id;
        $this->emit('reviewDiscussionModal_specialization');
    }
}
