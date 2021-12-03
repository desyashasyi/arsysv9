<?php

namespace Modules\Timetable\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScheduleRoom extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'timetable_room';

    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\ScheduleRoomFactory::new();
    }
}
