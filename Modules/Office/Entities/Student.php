<?php

namespace Modules\Office\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'student_number', 'code', 'user_id', 'program_id', 'specialization_id', 'supervisor_id', 'phone', 'email'];
    protected $table = 'arsys_student';

    public function program() {
        return $this->hasOne(StudyProgram::class, 'id', 'program_id');
    }
    public function specialization() {
        return $this->hasOne(StudySpecialization::class, 'id', 'specialization_id');
    }

    public function supervisor() {
        return $this->hasOne(Faculty::class, 'id', 'supervisor_id');
    }

    public function academicsupervisor() {
        return $this->hasOne(Faculty::class, 'id', 'supervisor_id');
    }

    public function account() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function research(){
        return $this->hasMany(Research::class, 'student_id', 'id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Office\Database\factories\StudentFactory::new();
    }
}
