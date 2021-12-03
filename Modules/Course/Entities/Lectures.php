<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lectures extends Model
{
    use HasFactory;

    protected $fillable = ['subject_code','subject_name', 'class', 'university', 'creator_id'];
    protected $table = 'timetable_lectures';

    public function faculty(){
        return $this->hasOne(Faculty::class, 'creator_id', 'id');
    }

    public function teacher(){
        return $this->hasMany(LecturesTeacher::class, 'lecture_id', 'id');
    }

    public function student(){
        return $this->hasMany(LecturesStudent::class, 'lecture_id', 'id');
    }

    public function meeting(){
        return $this->hasMany(LecturesMeeting::class, 'lecture_id', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\Lectures\Database\factories\LecturesFactory::new();
    }
}
