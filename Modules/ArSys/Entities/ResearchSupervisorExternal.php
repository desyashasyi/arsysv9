<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResearchSupervisorExternal extends Model
{
    use HasFactory;

    protected $fillable = ['research_id', 'supervisor_name', 'institution'];
    protected $table = 'arsys_research_supervisor_external';

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\ResearchSupervisorExternalFactory::new();
    }
}
