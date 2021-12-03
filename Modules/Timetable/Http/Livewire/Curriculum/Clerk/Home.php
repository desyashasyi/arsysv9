<?php

namespace Modules\Timetable\Http\Livewire\Curriculum\Clerk;

use Livewire\Component;

use Auth;
use Modules\Timetable\Entities\Subject;

class Home extends Component
{
    public function render()
    {
        $subjects = Subject::where('program_id', Auth::user()->faculty->program_id)
            ->orderBy('subject_code', 'ASC')
            ->paginate(10);
        return view('timetable::livewire.curriculum.clerk.home', compact('subjects'));
    }
}
