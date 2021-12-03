<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResearchMilestoneStatus extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'arsys_research_milestone_status';

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\ResearchMilestoneStatusFactory::new();
    }
}
