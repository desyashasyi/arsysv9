<?php

namespace Modules\Timetable\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Specialization extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'timetable_specialization';
    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\SpecializationFactory::new();
    }
}
