<?php

namespace Modules\Timetable\Http\Livewire\Schedule\Admin;

use Livewire\Component;
use Modules\Timetable\Entities\Schedule;
class StatusCheck extends Component
{
    public $scheduleId;

    protected $listeners = ['adminScheduleStatusCheck' => 'statusCheck',
                            ];
    public function render()
    {
        $facultytSchedule = null;
        if($this->scheduleId != null){
            $facultytSchedule = Schedule::where('id', $this->scheduleId)->first();
        }

        return view('timetable::livewire.schedule.admin.status-check', compact('facultytSchedule'));
    }
    public function statusCheck($schedule_id){
        $this->scheduleId = $schedule_id;
        $this->emit('adminScheduleCheckStatusModal');
    }

    public function close(){
        $this->scheduleId = null;
        //$this->emit('adminScheduleRefresh');
    }

    public function complete(){
        $schedule = Schedule::where('id', $this->scheduleId)->first();
        if($schedule->siak_status){
            Schedule::where('id', $this->scheduleId)->update([
                'siak_status' => false,
            ]);
        }else{
            Schedule::where('id', $this->scheduleId)->update([
                'siak_status' => true,
            ]);
        }
        $this->emit('startAdminSchedulePolling');
    }
}
