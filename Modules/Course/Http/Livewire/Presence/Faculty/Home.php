<?php

namespace Modules\Course\Http\Livewire\Presence\Faculty;
use Auth;
use Modules\Timetable\Entities\ScheduleYear;
use Modules\Timetable\Entities\Schedule;
use Livewire\WithPagination;

use Livewire\Component;

class Home extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $faculty = Auth::user()->faculty;
        $yearId = ScheduleYear::latest()->first()->id;

        $schedules = Schedule::where('year_id',$yearId)
            ->whereHas('team',function($query) use($faculty){
                $query->where('faculty_id',$faculty->id);
            })
            ->get();

        $schedule = Schedule::where('year_id',$yearId)
            ->whereHas('team',function($query) use($faculty){
                $query->where('faculty_id',$faculty->id);
            })
            ->latest()
            ->first();

        return view('course::livewire.presence.faculty.home',compact('schedules', 'schedule'));
    }
}
