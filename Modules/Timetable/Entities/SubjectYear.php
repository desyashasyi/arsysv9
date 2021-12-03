<?php

namespace Modules\Timetable\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubjectYear extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'timetable_subject_year';

    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\SubjectYearFactory::new();
    }
}
