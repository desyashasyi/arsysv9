<?php

namespace Modules\Office\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'academic_year';
    
    protected static function newFactory()
    {
        return \Modules\Office\Database\factories\AcademicYearFactory::new();
    }
}
