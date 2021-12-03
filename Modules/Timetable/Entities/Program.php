<?php

namespace Modules\Timetable\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'timetable_program';

    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\ProgramFactory::new();
    }
}
