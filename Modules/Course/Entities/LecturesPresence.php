<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LecturesPresence extends Model
{
    use HasFactory;

    protected $fillable = ['meeting_id', 'lecture_id', 'presence_time', 'student_id'];
    protected $table = 'timetable_lectures_presence';

    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\LecturesPresenceFactory::new();
    }
}
