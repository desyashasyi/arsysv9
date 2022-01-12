<?php

namespace Modules\ArSys\Http\Livewire\Config\Admin\Space;

use Livewire\Component;
use Modules\ArSys\Entities\EventSpace;

class Home extends Component
{

    public function render()
    {
        $spaces = EventSpace::all();
        return view('arsys::livewire.config.admin.space.home', compact('spaces'));
    }

    public function addEventSpace(){
        dd('add event space');
    }
}
