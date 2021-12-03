<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResearchMilestoneSeminar extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'arsys_research_milestone_seminar';

    protected static function newFactory()
    {
        return \Modules\ArSys\Database\factories\ResearchMilestroneSeminarFactory::new();
    }
}
