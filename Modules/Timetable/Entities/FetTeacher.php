<?php

namespace Modules\Timetable\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FetTeacher extends Model
{
    use HasFactory;

    protected $fillable = ['teacher_id', 'program_id'];
    protected $table = 'timetable_fet_teacher';
    public function faculty(){
        return $this->belongsTo(Faculty::class, 'teacher_id', 'id');
    }
    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\FetTeacherFactory::new();
    }
}
