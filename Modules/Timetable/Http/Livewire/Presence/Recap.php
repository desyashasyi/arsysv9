<?php

namespace Modules\Timetable\Http\Livewire\Presence;

use Livewire\Component;

use Modules\Timetable\Entities\Lectures;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Recap extends Component
{
    public $lectureId;
    use AuthorizesRequests;
    public function render()
    {
        $lecture = Lectures::where('id', $this->lectureId)->first();
        return view('timetable::livewire.presence.recap', compact('lecture'));
    }

    public function mount ($lecture_id){
        $this->lectureId = $lecture_id;
    }
}
