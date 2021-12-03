<?php

namespace Modules\ArSys\Http\Livewire\Review\Specialization;

use Livewire\Component;
use Modules\ArSys\Entities\Research;

class ViewAbstract extends Component
{
    public $research;
    public $listeners = ['researchReviewViewAbstract_Specialization' => 'viewAbstract'];
    public function render()
    {
        return view('arsys::livewire.review.specialization.view-abstract');
    }

    public function viewAbstract($id){
        
        $this->research = Research::where('id', $id)->first();
        $this->emit('researchReviewViewAbstractModal');
    }
}
