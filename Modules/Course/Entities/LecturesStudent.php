<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LecturesStudent extends Model
{
    use HasFactory;

    protected $fillable = ['lecture_id','student_number', 'student_name'];
    protected $table = 'timetable_lectures_student';

    public function lecture(){
        return $this->hasOne(Lectures::class, 'id', 'lecture_id');
    }

    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\LecturesStudentFactory::new();
    }
}
