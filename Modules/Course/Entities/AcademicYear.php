<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'timetable_academic_year';

    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\AcademicYearFactory::new();
    }
}
