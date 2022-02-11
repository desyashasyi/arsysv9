<?php

namespace Modules\Timetable\Http\Livewire\Schedule\Student;

use Livewire\Component;
use Auth;
use Modules\Timetable\Entities\ScheduleYear;
use Modules\Timetable\Entities\Schedule;
use Livewire\WithPagination;

class Lecture extends Component
{
    public $sortBy;
    public $search;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        //dd(Auth::user()->student-);

        //$programId = Auth::user()->student->program->id;
        $yearId = Scheduleyear::latest()->first()->id;

        $schedules = Schedule::where('year_id',$yearId)
            ->paginate(10);
        if($this->sortBy){
            $schedules = Schedule::where('year_id',$yearId)
            ->orderBy($this->sortBy, 'ASC')
            ->paginate(10);
        }

        $schedule = Schedule::where('year_id',$yearId)
            ->latest()
            ->first();

        return view('timetable::livewire.schedule.student.lecture',compact('schedules', 'schedule'));
    }

    public function sort($by){
        $this->sortBy = $by;
    }
}
