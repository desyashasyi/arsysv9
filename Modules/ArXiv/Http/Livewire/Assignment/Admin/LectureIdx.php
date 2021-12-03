<?php

namespace Modules\ArXiv\Http\Livewire\Assignment\Admin;

use Livewire\Component;

class LectureIdx extends Component
{
    public function render()
    {
        return view('arxiv::livewire.assignment.admin.lecture-idx')->layout('adminlte::page');
    }
}
