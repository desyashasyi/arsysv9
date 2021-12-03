<?php

namespace Modules\Timetable\Http\Livewire\Schedule\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Timetable\Imports\FETTimetableImport;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Timetable\Entities\Schedule;
use Modules\Timetable\Entities\ScheduleTeachingTeam;
use Modules\Timetable\Entities\ScheduleYear;
use Modules\Timetable\Entities\ScheduleAssignmentLetter;
use Livewire\WithPagination;

class Home extends Component
{
    public $pageName = 'scheduleHome';
    public $programId;
    public $wirePoll = false;
    public $timetableFile = null;
    use WithFileUploads;
    use WithPagination;
    public $addEditLetterNumberFlag =  false;
    public $letterNumber;
    protected $paginationTheme = 'bootstrap';
    public $listeners = ['selectStudyProgram' => 'fillProgram',
                        'adminScheduleRefresh' => '$refresh',
                        'startAdminSchedulePolling' => 'wirePollON',
                        ];

    public function fillProgram($studyProgramId){
        $this->programId = $studyProgramId['studyProgramId'];
        //$this->emit('selfRefresh');

        $this->resetPage();
    }

    public function wirePollON(){
        $this->wirePoll = true;
    }
    public function render()
    {
        $schedules = null;
        $schedule = null;

        if($this->programId != null){
            $schedule = Schedule::where('program_id', $this->programId)
                        ->where('year_id', ScheduleYear::latest()->first()->id)
                        ->latest()->first();
            $schedules = Schedule::where('program_id', $this->programId)
                    ->where('year_id', ScheduleYear::latest()->first()->id)
                    ->orderBy('activity_id', 'ASC')
                    ->paginate(50);
        }
        return view('timetable::livewire.schedule.admin.home', compact('schedules', 'schedule'));
    }


    public function documentStore(){
        $this->validate([
            'timetableFile' => "required|max:10000",
        ]);
        if($this->programId != null){
            $path1 = $this->timetableFile->store('temp');
            $path=storage_path('app').'/'.$path1;
            Excel::import(new FETTimetableImport($this->programId), $path);
        }else{
            $this->emit('errorMessage', 'The study program should be selected!' );
        }

    }

    public function addEditLetterNumber(){
        $this->addEditLetterNumberFlag = true;
    }

    public function saveLetterNumber($program_id, $year_id){
        $this->validate([
            'letterNumber' => 'required',
        ]);
        $this->addEditLetterNumberFlag = false;
        if(ScheduleAssignmentLetter::where('program_id', $program_id)
            ->where('year_id', $year_id)->first() == null){
            ScheduleAssignmentLetter::create([
                'program_id' => $program_id,
                'year_id' => $year_id,
                'number' => $this->letterNumber,
            ]);
        }
    }

    public function printAssignmentLetter($program_id, $year_id){
        return redirect()->route('timetable.schedule.admin.print.assignment-letter', ['program' => $program_id, 'year' => $year_id]);
    }

    public function setProgramId($program_id, $year_id){
        $schedules = Schedule::where('program_id', $program_id)
                ->where('year_id', $year_id)->get();
        foreach($schedules as $schedule){
            $teams = ScheduleTeachingTeam::where('schedule_id', $schedule->id)->get();
            foreach($teams as $team){
                ScheduleTeachingTeam::where('id', $team->id)->update([
                    'program_id' => $program_id,
                ]);
            }
        }

    }
}
