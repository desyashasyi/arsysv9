<?php

namespace Modules\ArSys\Http\Livewire\Research\Specialization;
use Livewire\Component;
use Modules\ArSys\Entities\AcademicYear;
use Modules\ArSys\Entities\Research;
use Modules\ArSys\Entities\ResearchType;
use Livewire\WithPagination;
use Auth;

class Expired extends Component
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
            ->where('approval_date', '<', $academicYear->start)
            ->where('research_milestone','!=', 17)
            ->orderBy('student_id', 'ASC')
            ->paginate(25);

        return view('arsys::livewire.research.specialization.expired', compact('researchs', 'academicYear'));
    }
}
