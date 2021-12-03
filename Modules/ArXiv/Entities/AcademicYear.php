<?php

namespace Modules\ArXiv\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = ['academic_year'];
    protected $table = 'academic_year';
    
    protected static function newFactory()
    {

        return \Modules\ArXiv\Database\factories\AcademicYearFactory::new();
    }
}
