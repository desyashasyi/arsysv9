<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResearchFileSupervisor extends Model
{
    use HasFactory;

    protected $fillable = ['research_id', 'file_id', 'supervisor_id'];
    protected $table = 'arsys_research_file_supervisor';

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\ResearchFileSupervisorFactory::new();
    }
}
