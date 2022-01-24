<?php

namespace Modules\Timetable\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'timetable_student';
    
    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\StudentFactory::new();
    }
}
