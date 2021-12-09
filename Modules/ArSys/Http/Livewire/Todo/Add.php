<?php

namespace Modules\ArSys\Http\Livewire\Todo;

use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\ArSys\Entities\Todo;
use Auth;


class Add extends Component
{
    public function render()
    {
        return view('arsys::livewire.todo.add');
    }
}
