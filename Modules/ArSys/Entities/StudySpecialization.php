<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudySpecialization extends Model
{
    use HasFactory;
    protected $fillable = [];
    protected $table = 'arsys_study_specialization';
}
