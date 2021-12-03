<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScheduleAssignmentLetter extends Model
{
    use HasFactory;
    use \Awobaz\Compoships\Compoships;

    protected $fillable = ['program_id', 'year_id', 'number', 'date'];
    protected $table = 'timetable_schedule_assignment_letter';

    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\ScheduleAssignmentLetterFactory::new();
    }
}
