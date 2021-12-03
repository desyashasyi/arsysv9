<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faculty extends Model
{
    use HasFactory;
    use \Awobaz\Compoships\Compoships;

    protected $fillable = [];
    protected $table = 'timetable_faculty';

    public function team() {
        return $this->hasMany(ScheduleTeachingTeam::class, 'faculty_id', 'id');
    }


    protected static function newFactory()
    {
        return \Modules\Timetable\Database\factories\FacultyFactory::new();
    }
}
