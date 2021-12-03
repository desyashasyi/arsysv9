<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScheduleYear extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'timetable_schedule_year';

    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\ScheduleYearFactory::new();
    }
}
