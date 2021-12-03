<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScheduleStudentSets extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'timetable_schedule_student_sets';

    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\ScheduleStudentSetsFactory::new();
    }
}
