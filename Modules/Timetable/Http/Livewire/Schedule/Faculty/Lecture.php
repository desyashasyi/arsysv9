<?php

namespace Modules\Timetable\Http\Livewire\Schedule\Faculty;

use Livewire\Component;
use Auth;
use Modules\Timetable\Entities\ScheduleYear;
use Modules\Timetable\Entities\Schedule;
use Livewire\WithPagination;

class Lecture extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $faculty = Auth::user()->faculty;
        $yearId = ScheduleYear::latest()->first()->id;

        $schedules = Schedule::where('year_id',$yearId)
            ->whereHas('teams',function($query) use($faculty){
                $query->where('faculty_id',$faculty->id);
            })
            ->get();

        $schedule = Schedule::where('year_id',$yearId)
            ->whereHas('teams',function($query) use($faculty){
                $query->where('faculty_id',$faculty->id);
            })
            ->latest()
            ->first();

        return view('timetable::livewire.schedule.faculty.lecture',compact('schedules', 'schedule'));
    }
}
