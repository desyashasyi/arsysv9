<?php

namespace Modules\Timetable\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use \Awobaz\Compoships\Compoships;
    use HasFactory;

    protected $fillable = ['activity_id','year_id', 'student_id', 'program_id', 'subject_id', 'room_id','daytime'];
    protected $table = 'timetable_schedule';

    public function program() {
        return $this->belongsTo(Program::class, 'program_id', 'id');
    }

    public function desc() {
        return $this->belongsTo(ScheduleYear::class, 'year_id', 'id');
    }
    public function subject() {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function team() {
        return $this->hasMany(ScheduleTeachingTeam::class, 'schedule_id', 'id');
    }

    public function room() {
        return $this->belongsTo(ScheduleRoom::class, 'room_id', 'id');
    }

    public function student() {
        return $this->belongsTo(ScheduleStudentSets::class, 'student_id', 'id');
    }

    public function activitytags() {
        return $this->hasMany(ScheduleActivityTags::class, 'schedule_id', 'id');
    }

    public function studentsets() {
        return $this->hasMany(ScheduleStudentSets::class, 'schedule_id', 'id');
    }

    public function assignmentletter(){
        return $this->belongsTo(ScheduleAssignmentLetter::class, ['year_id', 'program_id'], ['year_id', 'program_id']);
    }

    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\ScheduleFactory::new();
    }
}
