<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FacultyDuty extends Model
{
    use HasFactory;

    protected $fillable = ['faculty_id', 'duty_id'];
    protected $table = 'arsys_faculty_duty';

    public function type(){
        return $this->hasOne(FacultyDutyType::class, 'id', 'duty_id');
    }
    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\FacultyDutyFactory::new();
    }
}
