<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FacultyDutyType extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'arsys_faculty_duty_type';

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\FacultyDutyTypeFactory::new();
    }
}
