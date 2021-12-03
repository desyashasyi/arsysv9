<?php

namespace Modules\Timetable\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Timetable\Entities\Schedule;
use Modules\Timetable\Entities\ScheduleYear;
use Modules\Timetable\Entities\Faculty;
use PDF;
use Auth;
class PrintController extends Controller
{
    public function schedulePrintAssignmentLetter_Admin($program_id, $year_id){
        $user = Auth::user();
        if($user != null && $user->hasRole('admin')){
            $schedule = Schedule::where('program_id', $program_id)
                        ->where('year_id', $year_id)
                        ->latest()->first();
            $faculties = Faculty::whereHas('team', function($query) use ($program_id, $year_id){
                $query->where('year_id', $year_id)->where('program_id', $program_id);
            })
            ->orderBy('code', 'ASC')
            ->get();


            //$faculties = Faculty::orderby('code', 'ASC')->get();

            $assignmentPDF = PDF::loadView('timetable::livewire.print.admin.schedule-assignment-letter', ['schedule' => $schedule, 'faculties' => $faculties])
                ->setPaper('a4', 'landscape');
            return $assignmentPDF->stream('Jadwal '.$schedule->program->abbrev.'.pdf');

        }else
            return redirect()->route('arsys');
    }
}
