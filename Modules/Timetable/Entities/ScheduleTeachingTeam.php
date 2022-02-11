<?php

namespace Modules\Timetable\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScheduleTeachingTeam extends Model
{
    use HasFactory;

    protected $fillable = ['faculty_id', 'schedule_id', 'year_id', 'program_id'];
    protected $table = 'timetable_schedule_teaching_team';

    public function faculty() {
        return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
    }

    public function schedule() {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }

    
    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\ScheduleTeachingTeamFactory::new();
    }
}
