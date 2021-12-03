<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResearchSupervisorExternalDummy extends Model
{
    use HasFactory;

    protected $fillable = ['research_id', 'supervisor_name', 'institution'];
    protected $table = 'arsys_research_supervisor_external_dummy';

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\ResearchSupervisorExternalDummyFactory::new();
    }
}
