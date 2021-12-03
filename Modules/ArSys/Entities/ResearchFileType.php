<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResearchFileType extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'arsys_research_file_type';

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\ResearchFileTypeFactory::new();
    }
}
