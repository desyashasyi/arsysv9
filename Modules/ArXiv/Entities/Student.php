<?php

namespace Modules\ArXiv\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'arsys_student';

    public function program() {
        return $this->hasOne(StudyProgram::class, 'id', 'program_id');
    }
   
    protected static function newFactory()
    {
        return \Modules\ArXiv\Database\factories\StudentFactory::new();
    }
}
