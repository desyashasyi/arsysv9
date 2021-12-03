<?php

namespace Modules\ArXiv\Http\Livewire\Assignment\Admin;

use Livewire\Component;
use Modules\ArXiv\Entities\AcademicYear;

class Lecture extends Component
{
    public function render()
    {
        return view('arxiv::livewire.assignment.admin.lecture');
    }
}
