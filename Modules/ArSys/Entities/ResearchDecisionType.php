<?php

namespace Modules\ArSys\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchDecisionType extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'arsys_research_decision_type';

}
