<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
