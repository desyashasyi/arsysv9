<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubjectType extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'timetable_subject_type';


    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\SubjectTypeFactory::new();
    }
}
