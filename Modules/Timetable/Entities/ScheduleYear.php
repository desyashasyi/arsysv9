<?php

namespace Modules\Timetable\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScheduleYear extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'academic_year';

    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\ScheduleYearFactory::new();
    }
}
