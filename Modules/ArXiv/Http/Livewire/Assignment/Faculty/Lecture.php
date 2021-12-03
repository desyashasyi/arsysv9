<?php

namespace Modules\ArXiv\Http\Livewire\Assignment\Faculty;

use Livewire\Component;
use Auth;

use Modules\ArXiv\Entities\AcademicYear;
class Lecture extends Component
{
    public function render()
    {
        $academicYears = AcademicYear::all();
        return view('arxiv::livewire.assignment.faculty.lecture', compact('academicYears'));
    }
    
}
