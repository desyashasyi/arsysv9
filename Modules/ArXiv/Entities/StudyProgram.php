<?php

namespace Modules\ArXiv\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudyProgram extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected $table = 'arsys_study_program';
    protected static function newFactory()
    {
        return \Modules\ArXiv\Database\factories\ProgramFactory::new();
    }
}
