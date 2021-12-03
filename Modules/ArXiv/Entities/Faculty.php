<?php

namespace Modules\ArXiv\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $table = 'arsys_faculty';
    
    protected static function newFactory()
    {
        return \Modules\ArXiv\Database\factories\FacultyFactory::new();
    }
}
