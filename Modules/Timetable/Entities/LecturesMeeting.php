<?php

namespace Modules\Timetable\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LecturesMeeting extends Model
{
    use HasFactory;

    protected $fillable = ['lecture_id','meeting_date'];
    protected $table = 'timetable_lectures_meeting';

    public function presence(){
        return $this->hasMany(LecturesPresence::class, 'meeting_id', 'id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\LecturesMeetingFactory::new();
    }
}
