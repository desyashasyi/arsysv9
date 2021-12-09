<?php

namespace Modules\ArSys\Http\Livewire\Todo;

use Livewire\Component;
use Modules\ArSys\Entities\Research;
class TodoIdx extends Component
{
    public $researchId;
    public function render()
    {
        $research = Research::where('id', $id)->first();
        return view('arsys::livewire.todo.todo-idx', compact('research'));
    }

    public function mount($id){
        $this->researchId = $id;
    }
}
