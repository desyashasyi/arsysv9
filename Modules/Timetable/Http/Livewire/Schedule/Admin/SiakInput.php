<?php

namespace Modules\Timetable\Http\Livewire\Schedule\Admin;

use Livewire\Component;
use Modules\Timetable\Entities\Schedule;
use Livewire\WithPagination;
//use App\Http\Livewire\Traits\WithPagination;

class SiakInput extends Component
{

    public $pageName = 'siakInputPage';
    public $programId;
    public $yearId;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['adminScheduleSIAKInput' => 'siakInput',
                            ];
    public function render()
    {
        $schedules = null;
        if($this->programId != null){
            $schedules = Schedule::where('program_id', $this->programId)->where('year_id', $this->yearId)
                ->paginate(1)->onEachSide(2);

        }

        return view('timetable::livewire.schedule.admin.siak-input', compact('schedules'));
    }
    public function siakInput($program_id, $year_id){
        $this->programId = $program_id;
        $this->yearId = $year_id;
        $this->resetPage();
        $this->emit('adminScheduleSIAKInputModal');
    }

    public function close(){
        $this->programId = null;
        //$this->emit('adminScheduleRefresh');
    }

    public function complete($schedule_id){
        $schedule = Schedule::where('id', $schedule_id)->first();
        if($schedule->siak_status){
            Schedule::where('id', $schedule_id)->update([
                'siak_status' => false,
            ]);
        }else{
            Schedule::where('id', $schedule_id)->update([
                'siak_status' => true,
            ]);
        }
        $this->emit('startAdminSchedulePolling');
    }
}
