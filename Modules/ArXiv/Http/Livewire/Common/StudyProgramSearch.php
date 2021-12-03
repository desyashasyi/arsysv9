<?php

namespace Modules\ArXiv\Http\Livewire\Common;

use Livewire\Component;

class StudyProgramSearch extends Component
{
    public function render()
    {
        $this->dispatchBrowserEvent('contentChanged');
        return view('arxiv::livewire.common.study-program-search');
    }

}
