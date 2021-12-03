<?php

namespace Modules\CollabRe\Http\Livewire;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('collabre::livewire.index')->layout('adminlte::page');
    }
}
