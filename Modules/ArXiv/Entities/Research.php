<?php

namespace Modules\ArXiv\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Research extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'arsys_research';
    public function student(){
        return $this->hasOne(Student::class, 'id', 'student_id');
    }

    public function supervisor(){
        return $this->hasMany(ResearchSupervisor::class, 'research_id', 'id');
    }

    public function spvfile(){
        return $this->hasMany(ResearchFileSupervisor::class, 'research_id', 'id');
    }

    
    protected static function newFactory()
    {
        return \Modules\ArXiv\Database\factories\ResearchFactory::new();
    }
}
