<?php

namespace Modules\Timetable\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fet extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table='timetable_fet';

    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\FetComponentFactory::new();
    }
}
