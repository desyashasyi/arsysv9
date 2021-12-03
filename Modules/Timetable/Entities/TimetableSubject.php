<?php

namespace Modules\Timetable\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimetableSubject extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'timetable_subject';
    
    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\TimetableSubjectFactory::new();
    }
}
