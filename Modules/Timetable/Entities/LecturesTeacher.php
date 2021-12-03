<?php

namespace Modules\Timetable\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LecturesTeacher extends Model
{
    use HasFactory;

    protected $fillable = ['lecture_id', 'faculty_id'];
    protected $table = 'timetable_lectures_teacher';

    public function faculty(){
        return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\LecturesTeacherFactory::new();
    }
}
