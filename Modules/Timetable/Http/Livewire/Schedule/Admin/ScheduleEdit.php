<?php

namespace Modules\Timetable\Http\Livewire\Schedule\Admin;

use Livewire\Component;
use Modules\Timetable\Entities\Schedule;
use Modules\Timetable\Entities\ScheduleTeachingTeam;

class ScheduleEdit extends Component
{
    public $listeners = ['editSchedule_Admin' => 'editSchedule'];
    public $scheduleId;
    public function render()
    {
        $schedule = null;
        if($this->scheduleId){
            $schedule = Schedule::where('id', $this->scheduleId)->first();
        }
        return view('timetable::livewire.schedule.admin.schedule-edit', compact('schedule'));
    }
    public function editSchedule($schedule_id){
        $this->scheduleId = $schedule_id;
        $this->emit('editScheduleModal_Admin');
    }

    public function removeTeacher($teacher_id){
        ScheduleTeachingTeam::where('id', $teacher_id)->delete();
    }

    public function closeModal(){
        $this->emit('adminScheduleRefresh');

    }


}
