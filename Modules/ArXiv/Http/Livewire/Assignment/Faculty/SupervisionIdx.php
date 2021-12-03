<?php

namespace Modules\ArXiv\Http\Livewire\Assignment\Faculty;

use Livewire\Component;
use Auth;

class SupervisionIdx extends Component
{
    public function render()
    {
        return view('arxiv::livewire.assignment.faculty.supervision-idx')->layout('adminlte::page');
    }

   
}
