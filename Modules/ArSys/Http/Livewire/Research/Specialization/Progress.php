<?php

namespace Modules\ArSys\Http\Livewire\Research\Specialization;

use Livewire\Component;
use Modules\ArSys\Entities\AcademicYear;
use Modules\ArSys\Entities\Research;
use Livewire\WithPagination;
use Auth;

class Progress extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshSpecializationInProgress' => '$refresh'];
    public function render()
    {
        $academicYear = AcademicYear::latest()->first();
        $researchs = Research::whereHas('student', function($query){
                $query->where('specialization_id', Auth::user()->faculty->specialization_id);
            })
            //->where('academic_year_id', $academicYear->id)
            ->where('approval_date', '>', $academicYear->start)->paginate(25);

        return view('arsys::livewire.research.specialization.progress', compact('researchs', 'academicYear'));
    }
}
