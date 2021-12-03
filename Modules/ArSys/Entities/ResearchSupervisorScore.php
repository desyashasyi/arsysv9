<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResearchSupervisorScore extends Model
{
    use HasFactory;

    protected $fillable = ['applicant_id','supervisor_id', 'event_id', 'defense_note', 'mark'];
    protected $table = 'arsys_research_supervisor_score';

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\ResearchSupervisorScoreFactory::new();
    }
}
