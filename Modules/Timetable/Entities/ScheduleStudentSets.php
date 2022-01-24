<?php

namespace Modules\Timetable\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScheduleStudentSets extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'schedule_id', 'year_id', 'program_id'];
    protected $table = 'timetable_schedule_student_sets';


    public function student() {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function schedule() {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\ScheduleStudentSetsFactory::new();
    }
}
