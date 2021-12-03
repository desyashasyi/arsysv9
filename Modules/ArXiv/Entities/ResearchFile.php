<?php

namespace Modules\ArXiv\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResearchFile extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'arsys_research_file';
    
    protected static function newFactory()
    {
        return \Modules\ArXiv\Database\factories\ResearchFileFactory::new();
    }
}
