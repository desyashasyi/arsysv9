<?php
namespace Modules\ArSys\Http\Livewire\Research\Student;

use Livewire\Component;
use Modules\ArSys\Entities\Research;

class View extends Component
{
    public $researchId;
    public $researchData;

    protected $listeners = ['researchViewComponent' => 'researchView'];
    public function render()
    {
        return view('arsys::livewire.research.student.view');
    }
    public function researchView($id){
        $this->researchId = $id;
        $this->researchData = Research::where('id', $this->researchId)->first();
        $this->emit('hideAll');
        $this->emit('researchViewModal');
    }

}
