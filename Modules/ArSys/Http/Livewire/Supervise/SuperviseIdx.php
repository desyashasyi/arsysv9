<?php

namespace Modules\ArSys\Http\Livewire\Supervise;

use Livewire\Component;
use Modules\ArSys\Entities\Research;

class SuperviseIdx extends Component
{
    public $researchId;
    protected $listeners = [
        'refreshSuperviseIndex' => '$refresh',
    ];
    public function render()
    {
        $research = Research::where('id', $id)->first();
        return view('arsys::livewire.supervise.supervise-idx', compact('research'));
    }
    public function mount($id){
        $this->researchId = $id;
    }
}
